<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Nov 2019 13:08:55 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PosPemesananDetail
 * 
 * @property int $id_ppd
 * @property int $id_p_pemesanan
 * @property string $id_produk
 * @property float $jumlah
 * @property float $harga
 * 
 * @property \App\Models\PosPemesanan $pos_pemesanan
 * @property \App\Models\MasterProduk $master_produk
 *
 * @package App\Models
 */
class PosPemesananDetail extends Eloquent
{
	protected $table = 'pos__pemesanan_detail';
	protected $primaryKey = 'id_ppd';
	public $timestamps = false;

	protected $casts = [
		'id_p_pemesanan' => 'int',
		'jumlah' => 'float',
		'harga' => 'float'
	];

	protected $fillable = [
		'id_p_pemesanan',
		'id_produk',
		'jumlah',
		'harga'
	];

	public function pos_pemesanan()
	{
		return $this->belongsTo(\App\Models\PosPemesanan::class, 'id_p_pemesanan');
	}

	public function master_produk()
	{
		return $this->belongsTo(\App\Models\MasterProduk::class, 'id_produk');
	}
}
