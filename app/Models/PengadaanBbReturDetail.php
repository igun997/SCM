<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 18 Oct 2019 09:09:15 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PengadaanBbReturDetail
 *
 * @property int $id_pengadaan__bb_retur_detail
 * @property int $id_pengadaan_bb_detail
 * @property float $total_retur
 * @property string $catatan_retur
 * @property string $id_pengadaan_bb_retur
 *
 * @property \App\Models\PengadaanBbRetur $pengadaan_bb_retur
 * @property \App\Models\PengadaanBbDetail $pengadaan_bb_detail
 *
 * @package App\Models
 */
class PengadaanBbReturDetail extends Eloquent
{
	protected $table = 'pengadaan__bb_retur_detail';
	protected $primaryKey = 'id_pengadaan_bb_retur_detail';
	public $timestamps = false;

	protected $casts = [
		'id_pengadaan_bb_detail' => 'int',
		'total_retur' => 'float'
	];

	protected $fillable = [
		'id_pengadaan_bb_detail',
		'total_retur',
		'catatan_retur',
		'id_pengadaan_bb_retur'
	];

	public function pengadaan_bb_retur()
	{
		return $this->belongsTo(\App\Models\PengadaanBbRetur::class, 'id_pengadaan_bb_retur');
	}

	public function pengadaan_bb_detail()
	{
		return $this->belongsTo(\App\Models\PengadaanBbDetail::class, 'id_pengadaan_bb_detail');
	}
}
