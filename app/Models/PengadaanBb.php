<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PengadaanBb
 *
 * @property string $id_pengadaan_bb
 * @property string $id_suplier
 * @property int $status_pengadaan
 * @property \Carbon\Carbon $tgl_diterima
 * @property \Carbon\Carbon $tgl_register
 * @property int $konfirmasi_direktur
 * @property int $konfirmasi_gudang
 * @property string $catatan_gudang
 * @property string $catatan_direktur
 * @property \Carbon\Carbon $tgl_perubahan
 *
 * @property \App\Models\MasterSuplier $master_suplier
 * @property \Illuminate\Database\Eloquent\Collection $pengadaan__bb_details
 *
 * @package App\Models
 */
class PengadaanBb extends Eloquent
{
	protected $table = 'pengadaan__bb';
	protected $primaryKey = 'id_pengadaan_bb';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'status_pengadaan' => 'int',
		'konfirmasi_direktur' => 'int',
		'konfirmasi_gudang' => 'int'
	];

	protected $dates = [
		'tgl_diterima',
		'tgl_register',
		'tgl_perubahan'
	];

	protected $fillable = [
		'id_pengadaan_bb',
		'id_suplier',
		'status_pengadaan',
		'tgl_diterima',
		'tgl_register',
		'konfirmasi_direktur',
		'konfirmasi_gudang',
		'catatan_gudang',
		'perkiraan_tiba',
		'catatan_direktur',
		'dibaca_pengadaan',
		'dibaca_gudang',
		'dibaca_direktur',
		'tgl_perubahan'
	];

	public function master_suplier()
	{
		return $this->belongsTo(\App\Models\MasterSuplier::class, 'id_suplier');
	}

	public function pengadaan__bb_details()
	{
		return $this->hasMany(\App\Models\PengadaanBbDetail::class, 'id_pengadaan_bb');
	}
}
