<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 05 Sep 2019 12:54:01 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MasterKomposisi
 *
 * @property int $id_komposisi
 * @property string $id_produk
 * @property string $id_bb
 * @property float $jumlah
 * @property \Carbon\Carbon $tgl_register
 *
 * @property \App\Models\MasterBb $master_bb
 * @property \App\Models\MasterProduk $master_produk
 *
 * @package App\Models
 */
class MasterKomposisi extends Eloquent
{
	protected $table = 'master__komposisi';
	protected $primaryKey = 'id_komposisi';
	public $timestamps = false;

	protected $casts = [
		'jumlah' => 'float'
	];

	protected $dates = [
		'tgl_register'
	];

	protected $fillable = [
		'id_produk',
		'id_bb',
		'jumlah',
		'harga_bahan',
		'rasio',
		'tgl_register'
	];

	public function master_bb()
	{
		return $this->belongsTo(\App\Models\MasterBb::class, 'id_bb');
	}

	public function master_produk()
	{
		return $this->belongsTo(\App\Models\MasterProduk::class, 'id_produk');
	}
}
