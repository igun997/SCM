<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PengirimanDetail
 * 
 * @property int $id_pd
 * @property string $id_pengiriman
 * @property string $id_pemesanan
 * @property string $alamat_tujuan
 * @property string $catatan_khusus
 * 
 * @property \App\Models\Pengiriman $pengiriman
 * @property \App\Models\Pemesanan $pemesanan
 *
 * @package App\Models
 */
class PengirimanDetail extends Eloquent
{
	protected $table = 'pengiriman__detail';
	protected $primaryKey = 'id_pd';
	public $timestamps = false;

	protected $fillable = [
		'id_pengiriman',
		'id_pemesanan',
		'alamat_tujuan',
		'catatan_khusus'
	];

	public function pengiriman()
	{
		return $this->belongsTo(\App\Models\Pengiriman::class, 'id_pengiriman');
	}

	public function pemesanan()
	{
		return $this->belongsTo(\App\Models\Pemesanan::class, 'id_pemesanan');
	}
}
