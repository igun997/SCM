<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Dec 2019 19:19:04 +0000.
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
		'totalharga' => 'float'
	];

	protected $dates = [
		'dibuat'
	];

	protected $fillable = [
		'gerai_pelanggan_id',
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
		'alamat_antar',
		'catatan',
		'alamat_jemput'
	];

	public function gerai_driver()
	{
		return $this->belongsTo(\App\Models\GeraiDriver::class);
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
}
