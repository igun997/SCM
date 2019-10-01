<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class WncGerai
 *
 * @property string $id_gerai
 * @property string $nama_gerai
 * @property string $alamat
 * @property string $id_pemilik
 * @property string $id_mentor
 * @property int $status_gerai
 * @property \Carbon\Carbon $tgl_register
 *
 * @property \Illuminate\Database\Eloquent\Collection $wnc__produks
 *
 * @package App\Models
 */
class WncGerai extends Eloquent
{
	protected $table = 'wnc__gerai';
	protected $primaryKey = 'id_gerai';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'status_gerai' => 'int'
	];

	protected $dates = [
		'tgl_register'
	];

	protected $fillable = [
		'id_gerai',
		'nama_gerai',
		'alamat',
		'id_pemilik',
		'id_mentor',
		'status_gerai',
		'tgl_register'
	];

	public function wnc__produks()
	{
		return $this->hasMany(\App\Models\WncProduk::class, 'id_gerai');
	}
}
