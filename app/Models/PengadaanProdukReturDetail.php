<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 28 Oct 2019 10:11:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PengadaanProdukReturDetail
 * 
 * @property int $id_pengadaan_produk_retur_detail
 * @property int $id_pengadaan_produk_detail
 * @property float $total_retur
 * @property string $catatan_retur
 * @property string $id_pengadaan_produk_retur
 * 
 * @property \App\Models\PengadaanProdukRetur $pengadaan_produk_retur
 * @property \App\Models\PengadaanProdukDetail $pengadaan_produk_detail
 *
 * @package App\Models
 */
class PengadaanProdukReturDetail extends Eloquent
{
	protected $table = 'pengadaan__produk_retur_detail';
	protected $primaryKey = 'id_pengadaan_produk_retur_detail';
	public $timestamps = false;

	protected $casts = [
		'id_pengadaan_produk_detail' => 'int',
		'total_retur' => 'float'
	];

	protected $fillable = [
		'id_pengadaan_produk_detail',
		'total_retur',
		'catatan_retur',
		'id_pengadaan_produk_retur'
	];

	public function pengadaan_produk_retur()
	{
		return $this->belongsTo(\App\Models\PengadaanProdukRetur::class, 'id_pengadaan_produk_retur');
	}

	public function pengadaan_produk_detail()
	{
		return $this->belongsTo(\App\Models\PengadaanProdukDetail::class, 'id_pengadaan_produk_detail');
	}
}
