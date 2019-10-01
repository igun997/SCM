<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
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
		'status_pesanan' => 'int'
	];

	protected $dates = [
		'tgl_register'
	];

	protected $fillable = [
		'id_pemesanan',
		'id_pelanggan',
		'status_pesanan',
		'status_pembayaran',
		'catatan_pemesanan',
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

	public function pengiriman__details()
	{
		return $this->hasMany(\App\Models\PengirimanDetail::class, 'id_pemesanan');
	}
}
