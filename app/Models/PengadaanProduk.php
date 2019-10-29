<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 28 Oct 2019 10:11:00 +0000.
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
 * @property string $catatan_pengadaan
 * @property string $catatan_direktur
 * @property \Carbon\Carbon $perkiraan_tiba
 * @property \Carbon\Carbon $tgl_perubahan
 * @property int $dibaca_pengadaan
 * @property int $dibaca_direktur
 * @property int $dibaca_gudang
 *
 * @property \App\Models\MasterSuplier $master_suplier
 * @property \Illuminate\Database\Eloquent\Collection $pengadaan__produk_details
 * @property \Illuminate\Database\Eloquent\Collection $pengadaan__produk_returs
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
		'konfirmasi_gudang' => 'int',
		'dibaca_pengadaan' => 'int',
		'dibaca_direktur' => 'int',
		'dibaca_gudang' => 'int'
	];

	protected $dates = [
		'tgl_diterima',
		'tgl_register',
		'perkiraan_tiba',
		'tgl_perubahan'
	];

	protected $fillable = [
		'id_suplier',
		'id_pengadaan_produk',
		'status_pengadaan',
		'tgl_diterima',
		'tgl_register',
		'konfirmasi_direktur',
		'konfirmasi_gudang',
		'catatan_gudang',
		'catatan_pengadaan',
		'catatan_direktur',
		'perkiraan_tiba',
		'tgl_perubahan',
		'dibaca_pengadaan',
		'dibaca_direktur',
		'dibaca_gudang'
	];

	public function master_suplier()
	{
		return $this->belongsTo(\App\Models\MasterSuplier::class, 'id_suplier');
	}

	public function pengadaan__produk_details()
	{
		return $this->hasMany(\App\Models\PengadaanProdukDetail::class, 'id_pengadaan_produk');
	}

	public function pengadaan__produk_returs()
	{
		return $this->hasMany(\App\Models\PengadaanProdukRetur::class, 'id_pengadaan_produk');
	}
}
