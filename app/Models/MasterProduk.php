<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 06 Sep 2019 20:38:39 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MasterProduk
 *
 * @property string $id_produk
 * @property string $nama_produk
 * @property float $stok_minimum
 * @property float $stok
 * @property string $deskripsi
 * @property \Carbon\Carbon $kadaluarsa
 * @property int $id_satuan
 * @property float $harga_produksi
 * @property float $harga_distribusi
 * @property \Carbon\Carbon $tgl_register
 * @property \Carbon\Carbon $tgl_perubahan
 *
 * @property \App\Models\MasterSatuan $master_satuan
 * @property \Illuminate\Database\Eloquent\Collection $master__komposisis
 * @property \Illuminate\Database\Eloquent\Collection $pemesanan__details
 * @property \Illuminate\Database\Eloquent\Collection $pengadaan__produk_details
 * @property \Illuminate\Database\Eloquent\Collection $produksi__details
 *
 * @package App\Models
 */
class MasterProduk extends Eloquent
{
	protected $table = 'master__produk';
	protected $primaryKey = 'id_produk';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'stok_minimum' => 'float',
		'stok' => 'float',
		'id_satuan' => 'int',
		'harga_produksi' => 'float',
		'harga_distribusi' => 'float'
	];

	protected $dates = [
		'kadaluarsa',
		'tgl_register',
		'tgl_perubahan'
	];

	protected $fillable = [
		'id_produk',
		'nama_produk',
		'stok_minimum',
		'stok',
		'deskripsi',
		'kadaluarsa',
		'id_satuan',
		'harga_produksi',
		'harga_distribusi',
		'tgl_register',
		'tgl_perubahan'
	];

	public function master_satuan()
	{
		return $this->belongsTo(\App\Models\MasterSatuan::class, 'id_satuan');
	}

	public function master__komposisis()
	{
		return $this->hasMany(\App\Models\MasterKomposisi::class, 'id_produk');
	}

	public function pemesanan__details()
	{
		return $this->hasMany(\App\Models\PemesananDetail::class, 'id_produk');
	}

	public function pengadaan__produk_details()
	{
		return $this->hasMany(\App\Models\PengadaanProdukDetail::class, 'id_produk');
	}

	public function produksi__details()
	{
		return $this->hasMany(\App\Models\ProduksiDetail::class, 'id_produk');
	}
}
