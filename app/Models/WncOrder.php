<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class WncOrder
 *
 * @property string $id_order
 * @property string $nama_pemesan
 * @property string $id_pelanggan
 * @property int $status_order
 * @property int $dijemput
 * @property int $diantar
 * @property \Carbon\Carbon $tg_order
 *
 * @property \App\Models\WncPelanggan $wnc_pelanggan
 *
 * @package App\Models
 */
class WncOrder extends Eloquent
{
	protected $table = 'wnc__order';
	protected $primaryKey = 'id_order';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'status_order' => 'int',
		'dijemput' => 'int',
		'diantar' => 'int'
	];

	protected $dates = [
		'tg_order'
	];

	protected $fillable = [
		'id_order',
		'nama_pemesan',
		'id_pelanggan',
		'status_order',
		'dijemput',
		'diantar',
		'tg_order'
	];

	public function wnc_pelanggan()
	{
		return $this->belongsTo(\App\Models\WncPelanggan::class, 'id_pelanggan');
	}
}
