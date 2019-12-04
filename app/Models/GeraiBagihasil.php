<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Dec 2019 17:39:07 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GeraiBagihasil
 *
 * @property int $id
 * @property string $pemilik_id
 * @property string $mentor_id
 * @property float $pemilik
 * @property float $pusat
 * @property float $totalkotor
 * @property float $totalpesanan
 * @property string $periode
 * @property \Carbon\Carbon $dibuat
 *
 * @property \App\Models\Pengguna $pengguna
 *
 * @package App\Models
 */
class GeraiBagihasil extends Eloquent
{
	protected $table = 'gerai_bagihasil';
	public $timestamps = false;

	protected $casts = [
		'pemilik' => 'float',
		'pusat' => 'float',
		'totalkotor' => 'float',
		'totalpesanan' => 'float'
	];

	protected $dates = [
		'dibuat'
	];

	protected $fillable = [
		'pemilik_id',
		'mentor_id',
		'pemilik',
		'pusat',
		'totalkotor',
		'totalpesanan',
		'periode',
		'dibuat'
	];

	public function pemilik()
	{
		return $this->belongsTo(\App\Models\Pengguna::class, 'pemilik_id');
	}
	public function mentor()
	{
		return $this->belongsTo(\App\Models\Pengguna::class, 'mentor_id');
	}
}
