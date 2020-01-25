<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 25 Jan 2020 15:24:34 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Penyusutan
 *
 * @property string $kode_penyusutan
 * @property float $total_barang
 * @property float $estimasi_kerugian
 * @property string $ket
 * @property string $id_bb
 * @property string $id_produk
 * @property \Carbon\Carbon $tgl_register
 *
 * @property \App\Models\MasterBb $master_bb
 * @property \App\Models\MasterProduk $master_produk
 *
 * @package App\Models
 */
class Penyusutan extends Eloquent
{
	protected $table = 'penyusutan';
	protected $primaryKey = 'kode_penyusutan';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'total_barang' => 'float',
		'estimasi_kerugian' => 'float'
	];

	protected $dates = [
		'tgl_register'
	];

	protected $fillable = [
		'kode_penyusutan',
		'total_barang',
		'estimasi_kerugian',
		'ket',
		'bukti',
		'id_bb',
		'id_produk',
		'tgl_register'
	];

	public function master_bb()
	{
		return $this->belongsTo(\App\Models\MasterBb::class, 'id_bb');
	}

	public function master_produk()
	{
		return $this->belongsTo(\App\Models\MasterProduk::class, 'id_produk');
	}
}
