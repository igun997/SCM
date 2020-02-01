<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 01 Feb 2020 18:57:41 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PosRegister
 * 
 * @property int $id
 * @property int $pos_id
 * @property \Carbon\Carbon $check_in
 * @property \Carbon\Carbon $check_out
 * @property float $cash_start
 * @property int $cash_close
 * @property \Carbon\Carbon $tgl_register
 * 
 * @property \App\Models\Po $po
 * @property \Illuminate\Database\Eloquent\Collection $pos_transaksis
 *
 * @package App\Models
 */
class PosRegister extends Eloquent
{
	protected $table = 'pos_register';
	public $timestamps = false;

	protected $casts = [
		'pos_id' => 'int',
		'cash_start' => 'float',
		'cash_close' => 'int'
	];

	protected $dates = [
		'check_in',
		'check_out',
		'tgl_register'
	];

	protected $fillable = [
		'pos_id',
		'check_in',
		'check_out',
		'cash_start',
		'cash_close',
		'tgl_register'
	];

	public function po()
	{
		return $this->belongsTo(\App\Models\Po::class, 'pos_id');
	}

	public function pos_transaksis()
	{
		return $this->hasMany(\App\Models\PosTransaksi::class);
	}
}
