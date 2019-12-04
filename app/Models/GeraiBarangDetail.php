<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Dec 2019 17:39:01 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GeraiBarangDetail
 * 
 * @property int $id
 * @property string $jenis
 * @property float $qty
 * @property int $konf_pemilik
 * @property \Carbon\Carbon $tgl_konf
 * @property \Carbon\Carbon $dibuat
 * @property int $gerai_barang_id
 * 
 * @property \App\Models\GeraiBarang $gerai_barang
 *
 * @package App\Models
 */
class GeraiBarangDetail extends Eloquent
{
	protected $table = 'gerai_barang_detail';
	public $timestamps = false;

	protected $casts = [
		'qty' => 'float',
		'konf_pemilik' => 'int',
		'gerai_barang_id' => 'int'
	];

	protected $dates = [
		'tgl_konf',
		'dibuat'
	];

	protected $fillable = [
		'jenis',
		'qty',
		'konf_pemilik',
		'tgl_konf',
		'dibuat',
		'gerai_barang_id'
	];

	public function gerai_barang()
	{
		return $this->belongsTo(\App\Models\GeraiBarang::class);
	}
}
