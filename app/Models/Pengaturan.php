<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Pengaturan
 * 
 * @property int $id_pengaturan
 * @property float $keuntungan_ppn
 * @property float $keuntungan_mentor
 * @property float $keuntungan_marketing
 * @property float $keuntungan_pusat
 * @property float $kentungan_mitra
 * @property int $keuntungan_produksi
 * @property float $keuntungan_tukang
 * @property \Carbon\Carbon $tgl_perubahan
 *
 * @package App\Models
 */
class Pengaturan extends Eloquent
{
	protected $table = 'pengaturan';
	protected $primaryKey = 'id_pengaturan';
	public $timestamps = false;

	protected $casts = [
		'keuntungan_ppn' => 'float',
		'keuntungan_mentor' => 'float',
		'keuntungan_marketing' => 'float',
		'keuntungan_pusat' => 'float',
		'kentungan_mitra' => 'float',
		'keuntungan_produksi' => 'int',
		'keuntungan_tukang' => 'float'
	];

	protected $dates = [
		'tgl_perubahan'
	];

	protected $fillable = [
		'keuntungan_ppn',
		'keuntungan_mentor',
		'keuntungan_marketing',
		'keuntungan_pusat',
		'kentungan_mitra',
		'keuntungan_produksi',
		'keuntungan_tukang',
		'tgl_perubahan'
	];
}
