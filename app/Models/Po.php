<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Nov 2019 13:08:18 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Po
 * 
 * @property int $id_pos
 * @property string $nama_pengguna
 * @property string $cabang
 * @property string $alamat
 * @property string $username
 * @property string $password
 * @property bool $status
 * 
 * @property \Illuminate\Database\Eloquent\Collection $pos__pemesanans
 *
 * @package App\Models
 */
class Po extends Eloquent
{
	protected $primaryKey = 'id_pos';
	public $timestamps = false;

	protected $casts = [
		'status' => 'bool'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'nama_pengguna',
		'cabang',
		'alamat',
		'username',
		'password',
		'status'
	];

	public function pos__pemesanans()
	{
		return $this->hasMany(\App\Models\PosPemesanan::class, 'id_pos');
	}
}
