<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePengadaanProdukDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pengadaan__produk_detail', function(Blueprint $table)
		{
			$table->integer('id_pp_detail', true);
			$table->string('id_produk', 60)->index('id_bb');
			$table->float('jumlah', 10, 0);
			$table->float('harga', 10, 0);
			$table->string('id_pengadaan_produk', 60)->index('id_p_bb');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pengadaan__produk_detail');
	}

}
