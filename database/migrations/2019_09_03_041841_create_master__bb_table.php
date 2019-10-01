<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasterBbTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('master__bb', function(Blueprint $table)
		{
			$table->string('id_bb', 25)->primary();
			$table->string('nama', 50);
			$table->float('stok', 10, 0);
			$table->float('stok_minimum', 10, 0);
			$table->float('harga', 10, 0);
			$table->date('kadaluarsa')->nullable();
			$table->integer('id_satuan')->index('id_satuan');
			$table->timestamp('tgl_register')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('master__bb');
	}

}
