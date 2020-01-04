<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPengadaanProdukDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pengadaan__produk_detail', function(Blueprint $table)
		{
			$table->foreign('id_produk', 'pengadaan__produk_detail_ibfk_1')->references('id_produk')->on('master__produk')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_pengadaan_produk', 'pengadaan__produk_detail_ibfk_2')->references('id_pengadaan_produk')->on('pengadaan__produk')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pengadaan__produk_detail', function(Blueprint $table)
		{
			$table->dropForeign('pengadaan__produk_detail_ibfk_1');
			$table->dropForeign('pengadaan__produk_detail_ibfk_2');
		});
	}

}
