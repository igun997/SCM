<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Dec 2019 19:19:34 +0000.
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
 * @property string $jenis
 * @property \Carbon\Carbon $dibuat
 * 
 * @property \App\Models\Pengguna $pengguna
 * @property \Illuminate\Database\Eloquent\Collection $gerai_order_details
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
		'jenis',
		'dibuat'
	];

	public function pengguna()
	{
		return $this->belongsTo(\App\Models\Pengguna::class, 'pemilik_id');
	}

	public function gerai_order_details()
	{
		return $this->hasMany(\App\Models\GeraiOrderDetail::class);
	}
}
