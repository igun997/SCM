<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Dec 2019 17:38:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GeraiKontrol
 *
 * @property int $id
 * @property string $pemilik_id
 * @property string $mentor_id
 * @property string $catatan_keuangan
 * @property string $catatan_pelayanan
 * @property string $catatan_barang
 * @property int $status_kontrol
 * @property int $status_evaluasi
 * @property string $catatan_evaluasi
 * @property \Carbon\Carbon $dibuat
 *
 * @property \App\Models\Pengguna $pengguna
 *
 * @package App\Models
 */
class GeraiKontrol extends Eloquent
{
	protected $table = 'gerai_kontrol';
	public $timestamps = false;

	protected $casts = [
		'status_kontrol' => 'int',
	];

	protected $dates = [
		'dibuat'
	];

	protected $fillable = [
		'pemilik_id',
		'mentor_id',
		'catatan_keuangan',
		'catatan_pelayanan',
		'catatan_barang',
		'status_kontrol',
		'status_evaluasi',
		'catatan_evaluasi',
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
