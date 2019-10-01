<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Pengguna
 *
 * @property string $id_pengguna
 * @property string $nama_pengguna
 * @property string $no_kontak
 * @property string $alamat
 * @property string $jk
 * @property string $level
 * @property int $status
 * @property string $email
 * @property string $password
 * @property \Carbon\Carbon $tgl_register
 *
 * @property \Illuminate\Database\Eloquent\Collection $wnc__pelanggans
 *
 * @package App\Models
 */
class Pengguna extends Eloquent
{
	protected $table = 'pengguna';
	protected $primaryKey = 'id_pengguna';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'status' => 'int'
	];

	protected $dates = [
		'tgl_register'
	];



	protected $fillable = [
		'id_pengguna',
		'nama_pengguna',
		'no_kontak',
		'alamat',
		'jk',
		'level',
		'status',
		'email',
		'password',
		'tgl_register'
	];

	public function wnc__pelanggans()
	{
		return $this->hasMany(\App\Models\WncPelanggan::class, 'id_marketing');
	}
}
