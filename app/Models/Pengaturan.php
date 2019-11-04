<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Nov 2019 08:18:15 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Pengaturan
 * 
 * @property int $id_pengaturan
 * @property string $meta_key
 * @property string $meta_value
 * @property \Carbon\Carbon $valid
 *
 * @package App\Models
 */
class Pengaturan extends Eloquent
{
	protected $table = 'pengaturan';
	protected $primaryKey = 'id_pengaturan';
	public $timestamps = false;

	protected $dates = [
		'valid'
	];

	protected $fillable = [
		'meta_key',
		'meta_value',
		'valid'
	];
}
