<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MasterPelanggan
 *
 * @property string $id_pelanggan
 * @property string $nama_pelanggan
 * @property string $alamat
 * @property string $no_kontak
 * @property string $email
 * @property string $password
 * @property \Carbon\Carbon $tgl_register
 *
 * @property \Illuminate\Database\Eloquent\Collection $pemesanans
 *
 * @package App\Models
 */
class MasterPelanggan extends Eloquent
{
	protected $table = 'master__pelanggan';
	protected $primaryKey = 'id_pelanggan';
	public $incrementing = false;
	public $timestamps = false;

	protected $dates = [
		'tgl_register'
	];


	protected $fillable = [
		'id_pelanggan',
		'nama_pelanggan',
		'alamat',
		'no_kontak',
		'email',
		'password',
		'tgl_register'
	];

	public function pemesanans()
	{
		return $this->hasMany(\App\Models\Pemesanan::class, 'id_pelanggan');
	}
}
