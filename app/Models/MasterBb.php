<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MasterBb
 *
 * @property string $id_bb
 * @property string $nama
 * @property float $stok
 * @property float $stok_minimum
 * @property float $harga
 * @property \Carbon\Carbon $kadaluarsa
 * @property int $id_satuan
 * @property \Carbon\Carbon $tgl_register
 *
 * @property \App\Models\MasterSatuan $master_satuan
 * @property \Illuminate\Database\Eloquent\Collection $master__komposisis
 * @property \Illuminate\Database\Eloquent\Collection $pengadaan__bb_details
 *
 * @package App\Models
 */
class MasterBb extends Eloquent
{
	protected $table = 'master__bb';
	protected $primaryKey = 'id_bb';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'stok' => 'float',
		'stok_minimum' => 'float',
		'harga' => 'float',
		'id_satuan' => 'int'
	];

	protected $dates = [
		'kadaluarsa',
		'tgl_register'
	];

	protected $fillable = [
		'id_bb',
		'nama',
		'stok',
		'stok_minimum',
		'harga',
		'kadaluarsa',
		'id_satuan',
		'tgl_register'
	];

	public function master_satuan()
	{
		return $this->belongsTo(\App\Models\MasterSatuan::class, 'id_satuan');
	}

	public function master__komposisis()
	{
		return $this->hasMany(\App\Models\MasterKomposisi::class, 'id_bb');
	}

	public function pengadaan__bb_details()
	{
		return $this->hasMany(\App\Models\PengadaanBbDetail::class, 'id_bb');
	}
}
