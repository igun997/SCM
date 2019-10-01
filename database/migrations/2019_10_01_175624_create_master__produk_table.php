<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasterProdukTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('master__produk', function(Blueprint $table)
		{
			$table->string('id_produk', 60)->primary();
			$table->string('nama_produk', 60);
			$table->float('stok_minimum', 10, 0);
			$table->float('stok', 10, 0)->default(0);
			$table->text('deskripsi', 65535)->nullable();
			$table->date('kadaluarsa')->nullable();
			$table->integer('id_satuan')->index('id_satuan');
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
		Schema::drop('master__produk');
	}

}
