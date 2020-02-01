<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 01 Feb 2020 18:58:45 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PermintaanDetail
 * 
 * @property int $id
 * @property int $permintaan_id
 * @property string $id_produk
 * @property float $jumlah
 * 
 * @property \App\Models\MasterProduk $master_produk
 * @property \App\Models\Permintaan $permintaan
 *
 * @package App\Models
 */
class PermintaanDetail extends Eloquent
{
	protected $table = 'permintaan_detail';
	public $timestamps = false;

	protected $casts = [
		'permintaan_id' => 'int',
		'jumlah' => 'float'
	];

	protected $fillable = [
		'permintaan_id',
		'id_produk',
		'jumlah'
	];

	public function master_produk()
	{
		return $this->belongsTo(\App\Models\MasterProduk::class, 'id_produk');
	}

	public function permintaan()
	{
		return $this->belongsTo(\App\Models\Permintaan::class);
	}
}
