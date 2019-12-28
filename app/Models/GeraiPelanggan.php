<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Dec 2019 17:38:06 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GeraiPelanggan
 *
 * @property int $id
 * @property string $nama
 * @property int $jk
 * @property string $alamat
 * @property string $email
 * @property string $password
 * @property string $no_hp
 * @property int $status
 * @property \Carbon\Carbon $dibuat
 *
 * @property \Illuminate\Database\Eloquent\Collection $gerai_orders
 *
 * @package App\Models
 */
class GeraiPelanggan extends Eloquent
{
	protected $table = 'gerai_pelanggan';
	public $timestamps = false;

	protected $casts = [
		'jk' => 'int',
		'status' => 'int'
	];

	protected $dates = [
		'dibuat'
	];


	protected $fillable = [
		'nama',
		'jk',
		'alamat',
		'email',
		'lat',
		'lng',
		'password',
		'no_hp',
		'status',
		'dibuat'
	];

	public function gerai_orders()
	{
		return $this->hasMany(\App\Models\GeraiOrder::class);
	}
}
