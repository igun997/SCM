<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MasterSuplier
 *
 * @property string $id_suplier
 * @property string $nama_suplier
 * @property string $no_kontak
 * @property string $email
 * @property string $alamat
 * @property string $ket
 * @property \Carbon\Carbon $tgl_register
 *
 * @property \Illuminate\Database\Eloquent\Collection $pengadaan__bbs
 * @property \Illuminate\Database\Eloquent\Collection $pengadaan__produks
 *
 * @package App\Models
 */
class MasterSuplier extends Eloquent
{
	protected $table = 'master__suplier';
	protected $primaryKey = 'id_suplier';
	public $incrementing = false;
	public $timestamps = false;

	protected $dates = [
		'tgl_register'
	];

	protected $fillable = [
		'id_suplier',
		'nama_suplier',
		'no_kontak',
		'email',
		'alamat',
		'ket',
		'tgl_register'
	];

	public function pengadaan__bbs()
	{
		return $this->hasMany(\App\Models\PengadaanBb::class, 'id_suplier');
	}

	public function pengadaan__produks()
	{
		return $this->hasMany(\App\Models\PengadaanProduk::class, 'id_suplier');
	}
}
