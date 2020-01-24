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
			$table->integer('id_pbb_detail', true);
			$table->string('id_produk', 25)->index('id_produk');
			$table->float('jumlah', 10, 0);
			$table->float('harga', 10, 0);
			$table->string('id_pengadaan_produk', 25)->index('id_p_produk');
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
