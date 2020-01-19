<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 28 Oct 2019 10:11:16 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PengadaanProdukDetail
 *
 * @property int $id_pbb_detail
 * @property string $id_produk
 * @property float $jumlah
 * @property float $harga
 * @property string $id_pengadaan_produk
 *
 * @property \App\Models\MasterProduk $master_produk
 * @property \App\Models\PengadaanProduk $pengadaan_produk
 * @property \Illuminate\Database\Eloquent\Collection $pengadaan__produk_retur_details
 *
 * @package App\Models
 */
class PengadaanProdukDetail extends Eloquent
{
	protected $table = 'pengadaan__produk_detail';
	protected $primaryKey = 'id_pbb_detail';
	public $timestamps = false;

	protected $casts = [
		'jumlah' => 'float',
		'harga' => 'float'
	];

	protected $fillable = [
		'id_produk',
		'jumlah',
		'catatan',
		'harga',
		'id_pengadaan_produk'
	];

	public function master_produk()
	{
		return $this->belongsTo(\App\Models\MasterProduk::class, 'id_produk');
	}

	public function pengadaan_produk()
	{
		return $this->belongsTo(\App\Models\PengadaanProduk::class, 'id_pengadaan_produk');
	}

	public function pengadaan__produk_retur_details()
	{
		return $this->hasMany(\App\Models\PengadaanProdukReturDetail::class, 'id_pengadaan_produk_detail');
	}
}
