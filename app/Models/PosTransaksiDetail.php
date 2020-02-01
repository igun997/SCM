<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 01 Feb 2020 18:58:32 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PosTransaksiDetail
 * 
 * @property int $id
 * @property int $pos_transaksi_id
 * @property int $pos_barang_id
 * @property float $jumlah
 * @property float $harga
 * 
 * @property \App\Models\PosBarang $pos_barang
 * @property \App\Models\PosTransaksi $pos_transaksi
 *
 * @package App\Models
 */
class PosTransaksiDetail extends Eloquent
{
	protected $table = 'pos_transaksi_detail';
	public $timestamps = false;

	protected $casts = [
		'pos_transaksi_id' => 'int',
		'pos_barang_id' => 'int',
		'jumlah' => 'float',
		'harga' => 'float'
	];

	protected $fillable = [
		'pos_transaksi_id',
		'pos_barang_id',
		'jumlah',
		'harga'
	];

	public function pos_barang()
	{
		return $this->belongsTo(\App\Models\PosBarang::class);
	}

	public function pos_transaksi()
	{
		return $this->belongsTo(\App\Models\PosTransaksi::class);
	}
}
