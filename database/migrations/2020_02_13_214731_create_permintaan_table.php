<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermintaanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permintaan', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('pos_id')->index('pos_id');
			$table->timestamp('tgl_dibuat')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('status_permintaan')->default(0);
			$table->integer('konf_gudang')->default(0);
			$table->date('tgl_konfirmasi')->nullable();
			$table->dateTime('tgl_ambil')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('permintaan');
	}

}
