<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ProduksiDetail
 * 
 * @property int $id_pd
 * @property string $id_produksi
 * @property string $id_produk
 * @property float $jumlah
 * @property int $bahan_tersedia
 * @property \Carbon\Carbon $tgl_bahan_tersedia
 * @property string $catatan_untuk_pengadaan
 * 
 * @property \App\Models\Produksi $produksi
 * @property \App\Models\MasterProduk $master_produk
 *
 * @package App\Models
 */
class ProduksiDetail extends Eloquent
{
	protected $table = 'produksi__detail';
	protected $primaryKey = 'id_pd';
	public $timestamps = false;

	protected $casts = [
		'jumlah' => 'float',
		'bahan_tersedia' => 'int'
	];

	protected $dates = [
		'tgl_bahan_tersedia'
	];

	protected $fillable = [
		'id_produksi',
		'id_produk',
		'jumlah',
		'bahan_tersedia',
		'tgl_bahan_tersedia',
		'catatan_untuk_pengadaan'
	];

	public function produksi()
	{
		return $this->belongsTo(\App\Models\Produksi::class, 'id_produksi');
	}

	public function master_produk()
	{
		return $this->belongsTo(\App\Models\MasterProduk::class, 'id_produk');
	}
}
