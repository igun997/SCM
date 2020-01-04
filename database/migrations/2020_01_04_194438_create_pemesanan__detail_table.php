<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePemesananDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pemesanan__detail', function(Blueprint $table)
		{
			$table->integer('id_pd', true);
			$table->string('id_pemesanan', 60)->index('id_pemesanan');
			$table->string('id_produk', 60)->index('id_produk');
			$table->float('jumlah', 10, 0);
			$table->float('harga', 10, 0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pemesanan__detail');
	}

}
