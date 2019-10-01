<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Pengiriman
 *
 * @property string $id_pengiriman
 * @property string $id_transportasi
 * @property \Carbon\Carbon $tgl_pengiriman
 * @property \Carbon\Carbon $tgl_kembali
 * @property int $status_pengiriman
 * @property string $kontak_pengemudi
 * @property string $nama_pengemudi
 * @property string $catatan_khusus
 * @property \Carbon\Carbon $tgl_register
 *
 * @property \App\Models\MasterTransportasi $master_transportasi
 * @property \Illuminate\Database\Eloquent\Collection $pengiriman__details
 *
 * @package App\Models
 */
class Pengiriman extends Eloquent
{
	protected $table = 'pengiriman';
	protected $primaryKey = 'id_pengiriman';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'status_pengiriman' => 'int'
	];

	protected $dates = [
		'tgl_pengiriman',
		'tgl_kembali',
		'tgl_register'
	];

	protected $fillable = [
		'id_pengiriman',
		'id_transportasi',
		'tgl_pengiriman',
		'tgl_kembali',
		'status_pengiriman',
		'kontak_pengemudi',
		'nama_pengemudi',
		'catatan_khusus',
		'tgl_register'
	];

	public function master_transportasi()
	{
		return $this->belongsTo(\App\Models\MasterTransportasi::class, 'id_transportasi');
	}

	public function pengiriman__details()
	{
		return $this->hasMany(\App\Models\PengirimanDetail::class, 'id_pengiriman');
	}
}
