<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Nov 2019 13:13:05 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PosBarang
 * 
 * @property int $id_pb
 * @property string $id_produk
 * @property int $id_pos
 * 
 * @property \App\Models\Po $po
 * @property \App\Models\MasterProduk $master_produk
 *
 * @package App\Models
 */
class PosBarang extends Eloquent
{
	protected $table = 'pos__barang';
	protected $primaryKey = 'id_pb';
	public $timestamps = false;

	protected $casts = [
		'id_pos' => 'int'
	];

	protected $fillable = [
		'id_produk',
		'id_pos'
	];

	public function po()
	{
		return $this->belongsTo(\App\Models\Po::class, 'id_pos');
	}

	public function master_produk()
	{
		return $this->belongsTo(\App\Models\MasterProduk::class, 'id_produk');
	}
}
