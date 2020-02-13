<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermintaanDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permintaan_detail', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('permintaan_id')->index('permintaan_id');
			$table->string('id_produk', 60)->index('id_produk');
			$table->float('jumlah', 10, 0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('permintaan_detail');
	}

}
