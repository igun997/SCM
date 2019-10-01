<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 04:48:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MasterSatuan
 * 
 * @property int $id_satuan
 * @property string $nama_satuan
 * 
 * @property \Illuminate\Database\Eloquent\Collection $master__bbs
 *
 * @package App\Models
 */
class MasterSatuan extends Eloquent
{
	protected $table = 'master__satuan';
	protected $primaryKey = 'id_satuan';
	public $timestamps = false;

	protected $fillable = [
		'nama_satuan'
	];

	public function master__bbs()
	{
		return $this->hasMany(\App\Models\MasterBb::class, 'id_satuan');
	}
}
