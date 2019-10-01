<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProduksiDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produksi__detail', function(Blueprint $table)
		{
			$table->integer('id_pd', true);
			$table->string('id_produksi', 60)->index('id_produksi');
			$table->string('id_produk', 60)->index('id_produk');
			$table->float('jumlah', 10, 0);
			$table->integer('bahan_tersedia')->nullable()->default(1);
			$table->date('tgl_bahan_tersedia')->nullable();
			$table->text('catatan_untuk_pengadaan', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('produksi__detail');
	}

}
