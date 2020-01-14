<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MasterBb
 *
 * @property string $id_bb
 * @property string $nama
 * @property float $stok
 * @property float $stok_minimum
 * @property float $harga
 * @property \Carbon\Carbon $kadaluarsa
 * @property int $id_satuan
 * @property \Carbon\Carbon $tgl_register
 *
 * @property \App\Models\MasterSatuan $master_satuan
 * @property \Illuminate\Database\Eloquent\Collection $master__komposisis
 * @property \Illuminate\Database\Eloquent\Collection $pengadaan__bb_details
 *
 * @package App\Models
 */
class MasterBb extends Eloquent
{
	protected $table = 'master__bb';
	protected $primaryKey = 'id_bb';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'stok' => 'float',
		'stok_minimum' => 'float',
		'harga' => 'float',
		'id_satuan' => 'int'
	];

	protected $dates = [
		'kadaluarsa',
		'tgl_register'
	];

	protected $fillable = [
		'id_bb',
		'nama',
		'stok',
		'stok_minimum',
		'harga',
		'kadaluarsa',
		'id_satuan',
		'tgl_register'
	];

	public function master_satuan()
	{
		return $this->belongsTo(\App\Models\MasterSatuan::class, 'id_satuan');
	}

	public function master__komposisis()
	{
		return $this->hasMany(\App\Models\MasterKomposisi::class, 'id_bb');
	}
	public function total_masuk($id,$from,$to)
	{
		$obj = \App\Models\PengadaanBb::whereBetween("tgl_register",[$from,$to])->get();
		if ($obj->count() > 0) {
			$total = 0;
			foreach ($obj as $key => $value) {
				foreach ($value->pengadaan__bb_details as $k => $v) {
					if ($v->id_bb == $id) {
						$total = $total + $v->jumlah;
					}
				}
			}
			return $total;
		}else {
			return 0;
		}
	}
	public function total_keluar($id,$from,$to)
	{
		$obj = \App\Models\MasterKomposisi::where(["id_bb"=>$id]);
		$listBarang = [];
		$rasio = [];
		foreach ($obj->get() as $key => $value) {
			$listBarang[] = $value->master_produk->id_produk;
		}
		$listBarang = array_unique($listBarang);
		$obj1 = \App\Models\Produksi::whereBetween("tgl_register",[$from,$to]);
		if ($obj->count() > 0) {
			if ($obj1->count() > 0) {
				$total = 0;
				foreach ($obj1->get() as $key => $value) {
					foreach ($value->produksi__details as $k => $v) {
						if (in_array($v->id_produk,$listBarang)) {
							$s = \App\Models\MasterKomposisi::where(["id_produk"=>$v->id_produk,"id_bb"=>$id])->get();
							$implement = 0;
							foreach ($s as $ky => $e) {
								$implement = $implement + ($e->rasio*$e->jumlah);
							}
							$total = $total + ($implement*$v->jumlah);
						}
					}
				}
				return $total;
			}else {
				return 0;
			}
		}else {
			return 0;
		}
	}
	public function pengadaan__bb_details()
	{
		return $this->hasMany(\App\Models\PengadaanBbDetail::class, 'id_bb');
	}
}
