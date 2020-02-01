<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 01 Feb 2020 18:58:40 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Permintaan
 * 
 * @property int $id
 * @property int $pos_id
 * @property \Carbon\Carbon $tgl_dibuat
 * @property int $status_permintaan
 * @property int $konf_gudang
 * @property \Carbon\Carbon $tgl_konfirmasi
 * @property \Carbon\Carbon $tgl_ambil
 * 
 * @property \App\Models\Po $po
 * @property \Illuminate\Database\Eloquent\Collection $permintaan_details
 *
 * @package App\Models
 */
class Permintaan extends Eloquent
{
	protected $table = 'permintaan';
	public $timestamps = false;

	protected $casts = [
		'pos_id' => 'int',
		'status_permintaan' => 'int',
		'konf_gudang' => 'int'
	];

	protected $dates = [
		'tgl_dibuat',
		'tgl_konfirmasi',
		'tgl_ambil'
	];

	protected $fillable = [
		'pos_id',
		'tgl_dibuat',
		'status_permintaan',
		'konf_gudang',
		'tgl_konfirmasi',
		'tgl_ambil'
	];

	public function po()
	{
		return $this->belongsTo(\App\Models\Po::class, 'pos_id');
	}

	public function permintaan_details()
	{
		return $this->hasMany(\App\Models\PermintaanDetail::class);
	}
}
