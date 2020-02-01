<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 01 Feb 2020 18:57:35 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PosBarang
 * 
 * @property int $id
 * @property int $pos_id
 * @property string $id_produk
 * @property float $stok
 * @property float $harga
 * @property \Carbon\Carbon $tgl_update
 * @property \Carbon\Carbon $tgl_register
 * 
 * @property \App\Models\Po $po
 * @property \App\Models\MasterProduk $master_produk
 * @property \App\Models\PosTransaksiDetail $pos_transaksi_detail
 *
 * @package App\Models
 */
class PosBarang extends Eloquent
{
	protected $table = 'pos_barang';
	public $timestamps = false;

	protected $casts = [
		'pos_id' => 'int',
		'stok' => 'float',
		'harga' => 'float'
	];

	protected $dates = [
		'tgl_update',
		'tgl_register'
	];

	protected $fillable = [
		'pos_id',
		'id_produk',
		'stok',
		'harga',
		'tgl_update',
		'tgl_register'
	];

	public function po()
	{
		return $this->belongsTo(\App\Models\Po::class, 'pos_id');
	}

	public function master_produk()
	{
		return $this->belongsTo(\App\Models\MasterProduk::class, 'id_produk');
	}

	public function pos_transaksi_detail()
	{
		return $this->hasOne(\App\Models\PosTransaksiDetail::class);
	}
}
