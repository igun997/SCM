<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PengadaanProduk
 *
 * @property string $id_pengadaan_produk
 * @property string $id_suplier
 * @property int $status_pengadaan
 * @property \Carbon\Carbon $tgl_diterima
 * @property \Carbon\Carbon $tgl_register
 * @property int $konfirmasi_direktur
 * @property int $konfirmasi_gudang
 * @property string $catatan_gudang
 * @property string $catatan_direktur
 * @property \Carbon\Carbon $tgl_perubahan
 *
 * @property \App\Models\MasterSuplier $master_suplier
 * @property \Illuminate\Database\Eloquent\Collection $pengadaan__produk_details
 *
 * @package App\Models
 */
class PengadaanProduk extends Eloquent
{
	protected $table = 'pengadaan__produk';
	protected $primaryKey = 'id_pengadaan_produk';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'status_pengadaan' => 'int',
		'konfirmasi_direktur' => 'int',
		'konfirmasi_gudang' => 'int'
	];

	protected $dates = [
		'tgl_diterima',
		'tgl_register',
		'tgl_perubahan'
	];

	protected $fillable = [
		'id_pengadaan_produk',
		'id_suplier',
		'status_pengadaan',
		'tgl_diterima',
		'tgl_register',
		'konfirmasi_direktur',
		'konfirmasi_gudang',
		'catatan_gudang',
		'catatan_direktur',
		'tgl_perubahan'
	];

	public function master_suplier()
	{
		return $this->belongsTo(\App\Models\MasterSuplier::class, 'id_suplier');
	}

	public function pengadaan__produk_details()
	{
		return $this->hasMany(\App\Models\PengadaanProdukDetail::class, 'id_pengadaan_produk');
	}
}
