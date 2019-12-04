<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Dec 2019 17:40:01 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GeraiOrder
 * 
 * @property int $id
 * @property int $gerai_pelanggan_id
 * @property string $pengguna_id
 * @property int $gerai_layanan_id
 * @property int $qty
 * @property bool $dijemput
 * @property int $gerai_driver_id
 * @property int $jarak
 * @property float $totalharga
 * @property \Carbon\Carbon $dibuat
 * 
 * @property \App\Models\GeraiDriver $gerai_driver
 * @property \App\Models\GeraiLayanan $gerai_layanan
 * @property \App\Models\GeraiPelanggan $gerai_pelanggan
 * @property \App\Models\Pengguna $pengguna
 *
 * @package App\Models
 */
class GeraiOrder extends Eloquent
{
	protected $table = 'gerai_order';
	public $timestamps = false;

	protected $casts = [
		'gerai_pelanggan_id' => 'int',
		'gerai_layanan_id' => 'int',
		'qty' => 'int',
		'dijemput' => 'bool',
		'gerai_driver_id' => 'int',
		'jarak' => 'int',
		'totalharga' => 'float'
	];

	protected $dates = [
		'dibuat'
	];

	protected $fillable = [
		'gerai_pelanggan_id',
		'pengguna_id',
		'gerai_layanan_id',
		'qty',
		'dijemput',
		'gerai_driver_id',
		'jarak',
		'totalharga',
		'dibuat'
	];

	public function gerai_driver()
	{
		return $this->belongsTo(\App\Models\GeraiDriver::class);
	}

	public function gerai_layanan()
	{
		return $this->belongsTo(\App\Models\GeraiLayanan::class);
	}

	public function gerai_pelanggan()
	{
		return $this->belongsTo(\App\Models\GeraiPelanggan::class);
	}

	public function pengguna()
	{
		return $this->belongsTo(\App\Models\Pengguna::class);
	}
}
