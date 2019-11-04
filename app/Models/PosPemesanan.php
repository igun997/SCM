<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Nov 2019 13:08:39 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PosPemesanan
 * 
 * @property int $id_p_pemesanan
 * @property int $id_pos
 * @property int $status_pesanan
 * @property string $catatan_pemesanan
 * @property int $status_pembayaran
 * @property float $pajak
 * @property \Carbon\Carbon $tgl_register
 * 
 * @property \App\Models\Po $po
 * @property \Illuminate\Database\Eloquent\Collection $pos__pemesanan_details
 *
 * @package App\Models
 */
class PosPemesanan extends Eloquent
{
	protected $table = 'pos__pemesanan';
	protected $primaryKey = 'id_p_pemesanan';
	public $timestamps = false;

	protected $casts = [
		'id_pos' => 'int',
		'status_pesanan' => 'int',
		'status_pembayaran' => 'int',
		'pajak' => 'float'
	];

	protected $dates = [
		'tgl_register'
	];

	protected $fillable = [
		'id_pos',
		'status_pesanan',
		'catatan_pemesanan',
		'status_pembayaran',
		'pajak',
		'tgl_register'
	];

	public function po()
	{
		return $this->belongsTo(\App\Models\Po::class, 'id_pos');
	}

	public function pos__pemesanan_details()
	{
		return $this->hasMany(\App\Models\PosPemesananDetail::class, 'id_p_pemesanan');
	}
}
