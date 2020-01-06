<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 19 Dec 2019 12:06:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GeraiOrder
 *
 * @property int $id
 * @property int $gerai_pelanggan_id
 * @property string $pemilik_id
 * @property int $status_order
 * @property bool $dijemput
 * @property int $gerai_driver_id
 * @property int $jarak
 * @property float $totalharga
 * @property \Carbon\Carbon $dibuat
 * @property string $cLat
 * @property string $cLng
 * @property string $dLat
 * @property string $dLng
 * @property string $cLat_antar
 * @property string $cLng_antar
 * @property string $dLat_antar
 * @property string $dLng_antar
 * @property int $gerai_driver_id_antar
 * @property string $catatan
 * @property string $alamat_antar
 * @property string $alamat_jemput
 *
 * @property \App\Models\GeraiDriver $gerai_driver
 * @property \App\Models\GeraiPelanggan $gerai_pelanggan
 * @property \App\Models\Pengguna $pengguna
 * @property \Illuminate\Database\Eloquent\Collection $gerai_order_details
 *
 * @package App\Models
 */
class GeraiOrder extends Eloquent
{
	protected $table = 'gerai_order';
	public $timestamps = false;

	protected $casts = [
		'gerai_pelanggan_id' => 'int',
		'status_order' => 'int',
		'dijemput' => 'bool',
		'gerai_driver_id' => 'int',
		'jarak' => 'int',
		'offline' => 'bool',
		'totalharga' => 'float',
		'gerai_driver_id_antar' => 'int',
		"progress"=>"array"
	];

	protected $dates = [
		'dibuat'
	];

	protected $fillable = [
		'gerai_pelanggan_id',
		'progress',
		'offline',
		'pemilik_id',
		'status_order',
		'dijemput',
		'gerai_driver_id',
		'jarak',
		'totalharga',
		'dibuat',
		'cLat',
		'cLng',
		'dLat',
		'dLng',
		'ongkir_antar',
		'jarak_antar',
		'ongkir_jemput',
		'cLat_antar',
		'cLng_antar',
		'dLat_antar',
		'dLng_antar',
		'gerai_driver_id_antar',
		'catatan',
		'alamat_antar',
		'alamat_jemput'
	];

	public function gerai_driver_jemput()
	{
		return $this->belongsTo(\App\Models\GeraiDriver::class, 'gerai_driver_id');
	}
	public function gerai_driver_antar()
	{
		return $this->belongsTo(\App\Models\GeraiDriver::class, 'gerai_driver_id_antar');
	}

	public function gerai_pelanggan()
	{
		return $this->belongsTo(\App\Models\GeraiPelanggan::class);
	}

	public function pengguna()
	{
		return $this->belongsTo(\App\Models\Pengguna::class, 'pemilik_id');
	}

	public function gerai_order_details()
	{
		return $this->hasMany(\App\Models\GeraiOrderDetail::class);
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
}
