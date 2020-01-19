<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PengadaanBbDetail
 *
 * @property int $id_pbb_detail
 * @property string $id_bb
 * @property float $jumlah
 * @property float $harga
 * @property string $id_pengadaan_bb
 *
 * @property \App\Models\MasterBb $master_bb
 * @property \App\Models\PengadaanBb $pengadaan_bb
 *
 * @package App\Models
 */
class PengadaanBbDetail extends Eloquent
{
	protected $table = 'pengadaan__bb_detail';
	protected $primaryKey = 'id_pbb_detail';
	public $timestamps = false;

	protected $casts = [
		'jumlah' => 'float',
		'harga' => 'float'
	];

	protected $fillable = [
		'id_bb',
		'jumlah',
		'catatan',
		'harga',
		'id_pengadaan_bb'
	];

	public function master_bb()
	{
		return $this->belongsTo(\App\Models\MasterBb::class, 'id_bb');
	}

	public function pengadaan_bb()
	{
		return $this->belongsTo(\App\Models\PengadaanBb::class, 'id_pengadaan_bb');
	}
}
