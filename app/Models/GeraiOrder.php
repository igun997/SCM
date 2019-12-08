<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 05 Dec 2019 22:08:49 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GeraiOrder
 *
 * @property int $id
 * @property int $gerai_pelanggan_id
 * @property string $pemilik_id
 * @property int $gerai_layanan_id
 * @property int $status_order
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
		'status_order' => 'int',
		'qty' => 'int',
		'dijemput' => 'bool',
		'gerai_driver_id' => 'int',
		'jarak' => 'int',
		'totalharga' => 'float',
	];

	protected $dates = [
		'dibuat'
	];

	protected $fillable = [
		'gerai_pelanggan_id',
		'pemilik_id',
		'gerai_layanan_id',
		'status_order',
		'qty',
		'dijemput',
		'gerai_driver_id',
		'jarak',
		'totalharga',
		'cLat',
		'cLng',
		'dLat',
		'dLng',
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

	public function pemilik()
	{
		return $this->belongsTo(\App\Models\Pengguna::class, 'pemilik_id');
	}
	public function button($id)
	{
		if ($id == 0) {
			return null;
		}elseif ($id == 1) {
			return null;
		}elseif ($id == 2) {
			return "Pesanan Diterima Gerai";
		}elseif ($id == 3) {
			return "Pesanan Sedang Di Cuci";
		}elseif ($id == 4) {
			return "Pencucian Selesai";
		}elseif ($id == 5) {
			return "Sedang Di Antar Ke Tempat";
		}elseif ($id == 6) {
			return "Pesanan Selesai";
		}
	}
	public function booleanQuestion($id)
	{
		if ($id == null) {
			return "<span class='badge badge-default'>Belum Di Tentukan</span>";
		}elseif ($id == 0) {
			return "<span class='badge badge-primary'>Tidak</span>";
		}elseif ($id == 1) {
			return "<span class='badge badge-success'>Iya</span>";
		}
	}
	public function status_format($id)
	{
		if ($id == 0) {
			return "Menunggu Driver";
		}elseif ($id == 1) {
			return "Driver Antar Pesanan";
		}elseif ($id == 2) {
			return "Pesanan Diterima Gerai";
		}elseif ($id == 3) {
			return "Pesanan Sedang Di Cuci";
		}elseif ($id == 4) {
			return "Pencucian Selesai";
		}elseif ($id == 5) {
			return "Sedang Di Antar Ke Tempat";
		}elseif ($id == 6) {
			return "Pesanan Selesai";
		}
	}
}
