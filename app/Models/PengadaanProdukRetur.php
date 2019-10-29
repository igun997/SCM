<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 28 Oct 2019 10:11:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PengadaanProdukRetur
 *
 * @property string $id_pengadaan_produk_retur
 * @property \Carbon\Carbon $tanggal_retur
 * @property \Carbon\Carbon $tanggal_selesai
 * @property string $id_pengadaan_produk
 * @property bool $status_retur
 * @property bool $konfirmasi_direktur
 * @property bool $konfirmasi_pengadaan
 * @property string $catatan_direktur
 * @property string $catatan_pengadaan
 * @property string $catatan_gudang
 *
 * @property \App\Models\PengadaanProduk $pengadaan_produk
 * @property \Illuminate\Database\Eloquent\Collection $pengadaan__produk_retur_details
 *
 * @package App\Models
 */
class PengadaanProdukRetur extends Eloquent
{
	protected $table = 'pengadaan__produk_retur';
	protected $primaryKey = 'id_pengadaan_produk_retur';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'status_retur' => 'bool',
		'konfirmasi_direktur' => 'bool',
		'konfirmasi_pengadaan' => 'bool'
	];

	protected $dates = [
		'tanggal_retur',
		'tanggal_selesai'
	];

	protected $fillable = [
		'tanggal_retur',
		'tanggal_selesai',
		'id_pengadaan_produk_retur',
		'id_pengadaan_produk',
		'status_retur',
		'konfirmasi_direktur',
		'konfirmasi_pengadaan',
		'catatan_direktur',
		'catatan_pengadaan',
		'catatan_gudang'
	];

	public function pengadaan_produk()
	{
		return $this->belongsTo(\App\Models\PengadaanProduk::class, 'id_pengadaan_produk');
	}

	public function pengadaan__produk_retur_details()
	{
		return $this->hasMany(\App\Models\PengadaanProdukReturDetail::class, 'id_pengadaan_produk_retur');
	}
}
