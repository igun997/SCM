<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Dec 2019 17:42:46 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GeraiDriver
 *
 * @property int $id
 * @property string $nama
 * @property string $alamat
 * @property string $username
 * @property string $password
 * @property int $status
 * @property string $pemilik_id
 * @property \Carbon\Carbon $dibuat
 *
 * @property \App\Models\Pengguna $pengguna
 * @property \Illuminate\Database\Eloquent\Collection $gerai_orders
 *
 * @package App\Models
 */
class GeraiDriver extends Eloquent
{
	protected $table = 'gerai_driver';
	public $timestamps = false;

	protected $casts = [
		'status' => 'int'
	];

	protected $dates = [
		'dibuat'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'nama',
		'alamat',
		'username',
		'password',
		'status',
		'pemilik_id',
		'dibuat'
	];

	public function pemilik()
	{
		return $this->belongsTo(\App\Models\Pengguna::class, 'pemilik_id');
	}

	public function gerai_orders()
	{
		return $this->hasMany(\App\Models\GeraiOrder::class);
	}
}
