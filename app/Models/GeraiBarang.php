<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Dec 2019 17:38:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GeraiBarang
 *
 * @property int $id
 * @property string $nama_barang
 * @property string $deskripsi
 * @property string $pemilik_id
 * @property string $mentor_id
 * @property \Carbon\Carbon $dibuat
 *
 * @property \App\Models\Pengguna $pengguna
 * @property \Illuminate\Database\Eloquent\Collection $gerai_barang_details
 *
 * @package App\Models
 */
class GeraiBarang extends Eloquent
{
	protected $table = 'gerai_barang';
	public $timestamps = false;

	protected $dates = [
		'dibuat'
	];

	protected $fillable = [
		'nama_barang',
		'deskripsi',
		'pemilik_id',
		'mentor_id',
		'dibuat'
	];

	public function pemilik()
	{
		return $this->belongsTo(\App\Models\Pengguna::class, 'pemilik_id');
	}
	public function mentor()
	{
		return $this->belongsTo(\App\Models\Pengguna::class, 'mentor_id');
	}
	public function gerai_barang_details()
	{
		return $this->hasMany(\App\Models\GeraiBarangDetail::class);
	}
	public function stok($idbarang)
	{
		$minus = $this->hasMany(\App\Models\GeraiBarangDetail::class)->where(["konf_pemilik"=>1,"jenis"=>"keluar","gerai_barang_id"=>$idbarang])->sum("qty");
		$plus = $this->hasMany(\App\Models\GeraiBarangDetail::class)->where(["konf_pemilik"=>1,"jenis"=>"masuk","gerai_barang_id"=>$idbarang])->sum("qty");
		return (($plus*1) + ($minus*-1));
	}
}
