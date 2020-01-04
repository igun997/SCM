<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosPemesananDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pos__pemesanan_detail', function(Blueprint $table)
		{
			$table->integer('id_ppd', true);
			$table->integer('id_p_pemesanan')->index('iip');
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
		Schema::drop('pos__pemesanan_detail');
	}

}
