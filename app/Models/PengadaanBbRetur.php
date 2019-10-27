<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 18 Oct 2019 09:08:59 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PengadaanBbRetur
 *
 * @property string $id_pengadaan_bb_retur
 * @property \Carbon\Carbon $tanggal_retur
 * @property \Carbon\Carbon $tanggal_selesai
 * @property string $id_pengadaan_bb
 * @property bool $status_retur
 * @property bool $konfirmasi_direktur
 * @property bool $konfirmasi_pengadaan
 * @property string $catatan_direktur
 * @property string $catatan_pengadaan
 * @property string $catatan_gudang
 *
 * @property \App\Models\PengadaanBb $pengadaan_bb
 * @property \Illuminate\Database\Eloquent\Collection $pengadaan__bb_retur_details
 *
 * @package App\Models
 */
class PengadaanBbRetur extends Eloquent
{
	protected $table = 'pengadaan__bb_retur';
	protected $primaryKey = 'id_pengadaan_bb_retur';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'konfirmasi_direktur' => 'bool',
		'konfirmasi_pengadaan' => 'bool'
	];

	protected $dates = [
		'tanggal_retur',
		'tanggal_selesai'
	];

	protected $fillable = [
		'id_pengadaan_bb_retur',
		'tanggal_retur',
		'tanggal_selesai',
		'id_pengadaan_bb',
		'status_retur',
		'konfirmasi_direktur',
		'konfirmasi_pengadaan',
		'catatan_direktur',
		'catatan_pengadaan',
		'catatan_gudang'
	];

	public function pengadaan_bb()
	{
		return $this->belongsTo(\App\Models\PengadaanBb::class, 'id_pengadaan_bb');
	}

	public function pengadaan__bb_retur_details()
	{
		return $this->hasMany(\App\Models\PengadaanBbReturDetail::class, 'id_pengadaan_bb_retur');
	}
}
