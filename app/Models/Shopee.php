<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 28 Feb 2020 07:21:39 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Shopee
 * 
 * @property int $id
 * @property string $name
 * @property int $shop_id
 * @property string $status
 * @property int $time_created
 *
 * @package App\Models
 */
class Shopee extends Eloquent
{
	protected $table = 'shopee';
	public $timestamps = false;

	protected $casts = [
		'shop_id' => 'int',
		'time_created' => 'int'
	];

	protected $fillable = [
		'name',
		'shop_id',
		'status',
		'time_created'
	];
}
