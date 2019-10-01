<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWncProdukTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wnc__produk', function(Blueprint $table)
		{
			$table->string('id_produk', 60)->primary();
			$table->string('id_gerai', 60)->index('id_gerai');
			$table->string('nama_produk', 60);
			$table->float('stok_minimum', 10, 0);
			$table->float('stok', 10, 0);
			$table->text('deskripsi', 65535)->nullable();
			$table->date('kadaluarsa')->nullable();
			$table->float('harga_produksi', 10, 0)->nullable();
			$table->float('harga_distribusi', 10, 0)->nullable();
			$table->timestamp('tgl_register')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->date('tgl_perubahan')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wnc__produk');
	}

}
