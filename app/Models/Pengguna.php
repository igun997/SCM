<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 05 Dec 2019 22:06:27 +0000.
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
 * @property string $level
 * @property int $status
 * @property string $email
 * @property string $password
 * @property string $pengguna_id
 * @property \Carbon\Carbon $tgl_register
 *
 * @property \App\Models\Pengguna $pengguna
 * @property \Illuminate\Database\Eloquent\Collection $gerai_bagihasils
 * @property \Illuminate\Database\Eloquent\Collection $gerai_barangs
 * @property \Illuminate\Database\Eloquent\Collection $gerai_drivers
 * @property \Illuminate\Database\Eloquent\Collection $gerai_kontrols
 * @property \Illuminate\Database\Eloquent\Collection $gerai_layanans
 * @property \Illuminate\Database\Eloquent\Collection $gerai_orders
 * @property \Illuminate\Database\Eloquent\Collection $penggunas
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

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'id_pengguna',
		'nama_pengguna',
		'no_kontak',
		'alamat',
		'level',
		'status',
		'email',
		'password',
		'pengguna_id',
		'tgl_register'
	];

	public function pengguna()
	{
		return $this->belongsTo(\App\Models\Pengguna::class);
	}

	public function gerai_bagihasils()
	{
		return $this->hasMany(\App\Models\GeraiBagihasil::class, 'pemilik_id');
	}

	public function gerai_barangs()
	{
		return $this->hasMany(\App\Models\GeraiBarang::class, 'pemilik_id');
	}

	public function gerai_drivers()
	{
		return $this->hasMany(\App\Models\GeraiDriver::class, 'pemilik_id');
	}

	public function gerai_kontrols()
	{
		return $this->hasMany(\App\Models\GeraiKontrol::class, 'pemilik_id');
	}

	public function gerai_layanans()
	{
		return $this->hasMany(\App\Models\GeraiLayanan::class, 'pemilik_id');
	}

	public function gerai_orders()
	{
		return $this->hasMany(\App\Models\GeraiOrder::class, 'pemilik_id');
	}

	public function penggunas()
	{
		return $this->hasMany(\App\Models\Pengguna::class);
	}
}
