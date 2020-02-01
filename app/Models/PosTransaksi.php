<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 01 Feb 2020 18:57:47 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PosTransaksi
 * 
 * @property int $id
 * @property string $nama_pelanggan
 * @property int $tgl_transaksi
 * @property string $status
 * @property float $total_pembayaran
 * @property float $total_bayar
 * @property float $kembalian
 * @property int $pos_register_id
 * 
 * @property \App\Models\PosRegister $pos_register
 * @property \App\Models\PosTransaksiDetail $pos_transaksi_detail
 *
 * @package App\Models
 */
class PosTransaksi extends Eloquent
{
	protected $table = 'pos_transaksi';
	public $timestamps = false;

	protected $casts = [
		'tgl_transaksi' => 'int',
		'total_pembayaran' => 'float',
		'total_bayar' => 'float',
		'kembalian' => 'float',
		'pos_register_id' => 'int'
	];

	protected $fillable = [
		'nama_pelanggan',
		'tgl_transaksi',
		'status',
		'total_pembayaran',
		'total_bayar',
		'kembalian',
		'pos_register_id'
	];

	public function pos_register()
	{
		return $this->belongsTo(\App\Models\PosRegister::class);
	}

	public function pos_transaksi_detail()
	{
		return $this->hasOne(\App\Models\PosTransaksiDetail::class);
	}
}
