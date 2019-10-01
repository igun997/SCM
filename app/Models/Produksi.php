<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Produksi
 *
 * @property string $id_produksi
 * @property string $jenis
 * @property string $alasan_perencanaan
 * @property int $konfirmasi_perencanaan
 * @property string $catatan_perencanaan
 * @property int $konfirmasi_direktur
 * @property int $konfirmasi_gudang
 * @property string $catatan_gudang
 * @property string $catatan_direktur
 * @property int $status_produksi
 * @property \Carbon\Carbon $tgl_kon_direktur
 * @property \Carbon\Carbon $tgl_kon_gudang
 * @property \Carbon\Carbon $tgl_selesai_produksi
 * @property \Carbon\Carbon $tgl_register
 *
 * @property \Illuminate\Database\Eloquent\Collection $produksi__details
 *
 * @package App\Models
 */
class Produksi extends Eloquent
{
	protected $table = 'produksi';
	protected $primaryKey = 'id_produksi';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'konfirmasi_perencanaan' => 'int',
		'konfirmasi_direktur' => 'int',
		'konfirmasi_gudang' => 'int',
		'status_produksi' => 'int'
	];

	protected $dates = [
		'tgl_kon_direktur',
		'tgl_kon_gudang',
		'tgl_selesai_produksi',
		'tgl_register'
	];

	protected $fillable = [
		'id_produksi',
		'jenis',
		'alasan_perencanaan',
		'konfirmasi_perencanaan',
		'catatan_perencanaan',
		'konfirmasi_direktur',
		'konfirmasi_gudang',
		'catatan_gudang',
		'catatan_produksi',
		'catatan_direktur',
		'status_produksi',
		'tgl_kon_direktur',
		'tgl_kon_gudang',
		'tgl_selesai_produksi',
		'tgl_register'
	];

	public function produksi__details()
	{
		return $this->hasMany(\App\Models\ProduksiDetail::class, 'id_produksi');
	}
}
