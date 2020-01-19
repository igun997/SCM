<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PemesananDetail
 *
 * @property int $id_pd
 * @property string $id_pemesanan
 * @property string $id_produk
 * @property float $jumlah
 * @property float $harga
 *
 * @property \App\Models\Pemesanan $pemesanan
 * @property \App\Models\MasterProduk $master_produk
 *
 * @package App\Models
 */
class PemesananDetail extends Eloquent
{
	protected $table = 'pemesanan__detail';
	protected $primaryKey = 'id_pd';
	public $timestamps = false;

	protected $casts = [
		'jumlah' => 'float',
		'harga' => 'float'
	];

	protected $fillable = [
		'id_pemesanan',
		'id_produk',
		'jumlah',
		'harga'
	];

	public function pemesanan()
	{
		return $this->belongsTo(\App\Models\Pemesanan::class, 'id_pemesanan');
	}

	public function master_produk()
	{
		return $this->belongsTo(\App\Models\MasterProduk::class, 'id_produk');
	}
}
