<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 15 Nov 2019 17:38:16 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Pemesanan
 *
 * @property string $id_pemesanan
 * @property string $id_pelanggan
 * @property int $status_pesanan
 * @property string $catatan_pemesanan
 * @property int $status_pembayaran
 * @property string $bukti
 * @property float $pajak
 * @property \Carbon\Carbon $tgl_register
 *
 * @property \App\Models\MasterPelanggan $master_pelanggan
 * @property \Illuminate\Database\Eloquent\Collection $pemesanan__details
 * @property \Illuminate\Database\Eloquent\Collection $pengiriman__details
 *
 * @package App\Models
 */
class Pemesanan extends Eloquent
{
	protected $table = 'pemesanan';
	protected $primaryKey = 'id_pemesanan';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'status_pesanan' => 'int',
		'status_pembayaran' => 'int',
		'pajak' => 'float'
	];

	protected $dates = [
		'tgl_register'
	];

	protected $fillable = [
		'id_pelanggan',
		'id_pemesanan',
		'status_pesanan',
		'catatan_pemesanan',
		'status_pembayaran',
		'bukti',
		'pajak',
		'tgl_register'
	];

	public function master_pelanggan()
	{
		return $this->belongsTo(\App\Models\MasterPelanggan::class, 'id_pelanggan');
	}

	public function pemesanan__details()
	{
		return $this->hasMany(\App\Models\PemesananDetail::class, 'id_pemesanan');
	}
	public function totalharga($id)
	{
		$obj = \App\Models\PemesananDetail::where(["id_pemesanan"=>$id]);
		if ($obj->count() > 0) {
			$total = 9;
			$row = $obj;
			foreach ($row->get() as $key => $value) {
				$total = $total + ($value->jumlah*$value->harga);
			}
			return $total;
		}else {
			return 0;
		}
	}
	public function pengiriman__details()
	{
		return $this->hasMany(\App\Models\PengirimanDetail::class, 'id_pemesanan');
	}
}
