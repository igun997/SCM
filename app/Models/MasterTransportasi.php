<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MasterTransportasi
 *
 * @property string $id_transportasi
 * @property string $jenis_transportasi
 * @property string $no_polisi
 * @property int $status_kendaraan
 * @property \Carbon\Carbon $tgl_register
 *
 * @property \Illuminate\Database\Eloquent\Collection $pengirimen
 *
 * @package App\Models
 */
class MasterTransportasi extends Eloquent
{
	protected $table = 'master__transportasi';
	protected $primaryKey = 'id_transportasi';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'status_kendaraan' => 'int'
	];

	protected $dates = [
		'tgl_register'
	];

	protected $fillable = [
		'id_transportasi',
		'jenis_transportasi',
		'no_polisi',
		'status_kendaraan',
		'tgl_register'
	];

	public function pengirimen()
	{
		return $this->hasMany(\App\Models\Pengiriman::class, 'id_transportasi');
	}
}
