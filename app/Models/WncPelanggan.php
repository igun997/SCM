<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class WncPelanggan
 *
 * @property string $id_pelanggan
 * @property string $nama_pelanggan
 * @property string $jk
 * @property string $alamat
 * @property string $no_kontak
 * @property string $pekerjaan
 * @property string $id_marketing
 * @property \Carbon\Carbon $tgl_register
 *
 * @property \App\Models\Pengguna $pengguna
 * @property \Illuminate\Database\Eloquent\Collection $wnc__orders
 *
 * @package App\Models
 */
class WncPelanggan extends Eloquent
{
	protected $table = 'wnc__pelanggan';
	protected $primaryKey = 'id_pelanggan';
	public $incrementing = false;
	public $timestamps = false;

	protected $dates = [
		'tgl_register'
	];

	protected $fillable = [
		'id_pelanggan',
		'nama_pelanggan',
		'jk',
		'alamat',
		'no_kontak',
		'pekerjaan',
		'id_marketing',
		'tgl_register'
	];

	public function pengguna()
	{
		return $this->belongsTo(\App\Models\Pengguna::class, 'id_marketing');
	}

	public function wnc__orders()
	{
		return $this->hasMany(\App\Models\WncOrder::class, 'id_pelanggan');
	}
}
