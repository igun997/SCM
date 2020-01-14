<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 15 Jan 2020 01:18:24 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PeramalanProduksi
 * 
 * @property int $id
 * @property string $id_produk
 * @property float $prakira
 * @property \Carbon\Carbon $tgl_dibuat
 * @property string $jenis
 * 
 * @property \App\Models\MasterProduk $master_produk
 *
 * @package App\Models
 */
class PeramalanProduksi extends Eloquent
{
	protected $table = 'peramalan__produksi';
	public $timestamps = false;

	protected $casts = [
		'prakira' => 'float'
	];

	protected $dates = [
		'tgl_dibuat'
	];

	protected $fillable = [
		'id_produk',
		'prakira',
		'tgl_dibuat',
		'jenis'
	];

	public function master_produk()
	{
		return $this->belongsTo(\App\Models\MasterProduk::class, 'id_produk');
	}
}
