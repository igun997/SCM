<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 06 Sep 2019 20:38:39 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MasterProduk
 *
 * @property string $id_produk
 * @property string $nama_produk
 * @property float $stok_minimum
 * @property float $stok
 * @property string $deskripsi
 * @property \Carbon\Carbon $kadaluarsa
 * @property int $id_satuan
 * @property float $harga_produksi
 * @property float $harga_distribusi
 * @property \Carbon\Carbon $tgl_register
 * @property \Carbon\Carbon $tgl_perubahan
 *
 * @property \App\Models\MasterSatuan $master_satuan
 * @property \Illuminate\Database\Eloquent\Collection $master__komposisis
 * @property \Illuminate\Database\Eloquent\Collection $pemesanan__details
 * @property \Illuminate\Database\Eloquent\Collection $pengadaan__produk_details
 * @property \Illuminate\Database\Eloquent\Collection $produksi__details
 *
 * @package App\Models
 */
class MasterProduk extends Eloquent
{
	protected $table = 'master__produk';
	protected $primaryKey = 'id_produk';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'stok_minimum' => 'float',
		'stok' => 'float',
		'id_satuan' => 'int',
		'harga_produksi' => 'float',
		'harga_distribusi' => 'float'
	];

	protected $dates = [
		'kadaluarsa',
		'tgl_register',
		'tgl_perubahan'
	];

	protected $fillable = [
		'id_produk',
		'nama_produk',
		'stok_minimum',
		'stok',
		'deskripsi',
		'kadaluarsa',
		'id_satuan',
		'harga_produksi',
		'harga_distribusi',
		'tgl_register',
		'tgl_perubahan'
	];

	public function master_satuan()
	{
		return $this->belongsTo(\App\Models\MasterSatuan::class, 'id_satuan');
	}

	public function master__komposisis()
	{
		return $this->hasMany(\App\Models\MasterKomposisi::class, 'id_produk');
	}

	public function pemesanan__details()
	{
		return $this->hasMany(\App\Models\PemesananDetail::class, 'id_produk');
	}

	public function pengadaan__produk_details()
	{
		return $this->hasMany(\App\Models\PengadaanProdukDetail::class, 'id_produk');
	}

	public function produksi__details()
	{
		return $this->hasMany(\App\Models\ProduksiDetail::class, 'id_produk');
	}
	public function total_masuk($id,$from,$to)
	{
		$obj = \App\Models\PengadaanProduk::whereBetween("tgl_register",[$from,$to]);
		$obj1 = \App\Models\Produksi::whereBetween("tgl_register",[$from,$to]);
		$total = 0;
		foreach ($obj->get() as $key => $value) {
			foreach ($value->pengadaan__produk_details as $k => $v) {
				if ($v->id_produk == $id) {
					$total = $total + $v->jumlah;
				}
			}
		}
		$total_prod = 0;
		if ($obj1->count() > 0) {
			foreach ($obj1->get() as $key => $value) {
				foreach ($value->produksi__details as $k => $v) {
					if ($v->id_produk == $id) {
						$total_prod = $total_prod + $v->jumlah;
					}
				}
			}
		}
		return ($total+$total_prod);
	}
	public function total_keluar($id,$from=null,$to=null)
	{
		$obj = \App\Models\Pemesanan::whereBetween("tgl_register",[$from,$to])->get();
		if ($from == null) {
			$obj = \App\Models\Pemesanan::all();
		}
		if ($obj->count() > 0) {
			$total = 0;
			foreach ($obj as $key => $value) {
				foreach ($value->pemesanan__details as $k => $v) {
					if ($v->id_produk == $id) {
						$total = $total + $v->jumlah;
					}
				}
			}
			return $total;
		}else {
			return 0;
		}
	}
	public function total_keluar_hilang($id,$from,$to)
	{
		$obj = \App\Models\Penyusutan::whereBetween("tgl_register",[$from,$to])->get();
		if ($obj->count() > 0) {
			$total = 0;
			foreach ($obj as $key => $value) {
				if ($value->id_produk == $id) {
					$total = $total + $value->total_barang;
				}
			}
			return $total;
		}else {
			return 0;
		}
	}

}
