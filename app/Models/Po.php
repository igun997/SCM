<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 01 Feb 2020 19:00:16 +0700.
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
 * @property string $level
 * @property int $pos_id
 * 
 * @property \App\Models\Po $po
 * @property \Illuminate\Database\Eloquent\Collection $permintaans
 * @property \Illuminate\Database\Eloquent\Collection $pos_barangs
 * @property \Illuminate\Database\Eloquent\Collection $pos_registers
 *
 * @package App\Models
 */
class Po extends Eloquent
{
	protected $primaryKey = 'id_pos';
	public $timestamps = false;

	protected $casts = [
		'status' => 'bool',
		'pos_id' => 'int'
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
		'status',
		'level',
		'pos_id'
	];

	public function po()
	{
		return $this->hasOne(\App\Models\Po::class, 'id_pos', 'pos_id');
	}

	public function permintaans()
	{
		return $this->hasMany(\App\Models\Permintaan::class, 'pos_id');
	}

	public function pos_barangs()
	{
		return $this->hasMany(\App\Models\PosBarang::class, 'pos_id');
	}

	public function pos_registers()
	{
		return $this->hasMany(\App\Models\PosRegister::class, 'pos_id');
	}
}
