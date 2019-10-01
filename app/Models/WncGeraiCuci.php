<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class WncGeraiCuci
 *
 * @property string $id_gc
 * @property int $id_tukangcuci
 * @property int $status
 * @property \Carbon\Carbon $tgl_register
 *
 * @package App\Models
 */
class WncGeraiCuci extends Eloquent
{
	protected $table = 'wnc__gerai_cuci';
	protected $primaryKey = 'id_gc';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_tukangcuci' => 'int',
		'status' => 'int'
	];

	protected $dates = [
		'tgl_register'
	];

	protected $fillable = [
		'id_gc',
		'id_tukangcuci',
		'status',
		'tgl_register'
	];
}
