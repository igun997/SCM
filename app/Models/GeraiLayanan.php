<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Dec 2019 17:41:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GeraiLayanan
 *
 * @property int $id
 * @property string $pemilik_id
 * @property string $nama
 * @property float $harga
 * @property string $foto
 * @property \Carbon\Carbon $dibuat
 *
 * @property \App\Models\Pengguna $pengguna
 * @property \Illuminate\Database\Eloquent\Collection $gerai_orders
 *
 * @package App\Models
 */
class GeraiLayanan extends Eloquent
{
	protected $table = 'gerai_layanan';
	public $timestamps = false;

	protected $casts = [
		'harga' => 'float'
	];

	protected $dates = [
		'dibuat'
	];

	protected $fillable = [
		'pemilik_id',
		'nama',
		'harga',
		'foto',
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
