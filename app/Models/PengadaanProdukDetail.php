<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PengadaanProdukDetail
 * 
 * @property int $id_pp_detail
 * @property string $id_produk
 * @property float $jumlah
 * @property float $harga
 * @property string $id_pengadaan_produk
 * 
 * @property \App\Models\MasterProduk $master_produk
 * @property \App\Models\PengadaanProduk $pengadaan_produk
 *
 * @package App\Models
 */
class PengadaanProdukDetail extends Eloquent
{
	protected $table = 'pengadaan__produk_detail';
	protected $primaryKey = 'id_pp_detail';
	public $timestamps = false;

	protected $casts = [
		'jumlah' => 'float',
		'harga' => 'float'
	];

	protected $fillable = [
		'id_produk',
		'jumlah',
		'harga',
		'id_pengadaan_produk'
	];

	public function master_produk()
	{
		return $this->belongsTo(\App\Models\MasterProduk::class, 'id_produk');
	}

	public function pengadaan_produk()
	{
		return $this->belongsTo(\App\Models\PengadaanProduk::class, 'id_pengadaan_produk');
	}
}
