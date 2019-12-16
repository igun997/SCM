<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Dec 2019 19:19:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GeraiOrderDetail
 * 
 * @property int $id
 * @property int $gerai_order_id
 * @property int $gerai_layanan_id
 * @property int $qty
 * 
 * @property \App\Models\GeraiLayanan $gerai_layanan
 * @property \App\Models\GeraiOrder $gerai_order
 *
 * @package App\Models
 */
class GeraiOrderDetail extends Eloquent
{
	protected $table = 'gerai_order_detail';
	public $timestamps = false;

	protected $casts = [
		'gerai_order_id' => 'int',
		'gerai_layanan_id' => 'int',
		'qty' => 'int'
	];

	protected $fillable = [
		'gerai_order_id',
		'gerai_layanan_id',
		'qty'
	];

	public function gerai_layanan()
	{
		return $this->belongsTo(\App\Models\GeraiLayanan::class);
	}

	public function gerai_order()
	{
		return $this->belongsTo(\App\Models\GeraiOrder::class);
	}
}
