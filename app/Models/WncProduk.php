<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class WncProduk
 *
 * @property string $id_produk
 * @property string $id_gerai
 * @property string $nama_produk
 * @property float $stok_minimum
 * @property float $stok
 * @property string $deskripsi
 * @property \Carbon\Carbon $kadaluarsa
 * @property float $harga_produksi
 * @property float $harga_distribusi
 * @property \Carbon\Carbon $tgl_register
 * @property \Carbon\Carbon $tgl_perubahan
 *
 * @property \App\Models\WncGerai $wnc_gerai
 *
 * @package App\Models
 */
class WncProduk extends Eloquent
{
	protected $table = 'wnc__produk';
	protected $primaryKey = 'id_produk';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'stok_minimum' => 'float',
		'stok' => 'float',
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
		'id_gerai',
		'nama_produk',
		'stok_minimum',
		'stok',
		'deskripsi',
		'kadaluarsa',
		'harga_produksi',
		'harga_distribusi',
		'tgl_register',
		'tgl_perubahan'
	];

	public function wnc_gerai()
	{
		return $this->belongsTo(\App\Models\WncGerai::class, 'id_gerai');
	}
}
