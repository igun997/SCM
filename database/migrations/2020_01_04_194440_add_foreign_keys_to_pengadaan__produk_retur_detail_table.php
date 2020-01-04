<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPengadaanProdukReturDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pengadaan__produk_retur_detail', function(Blueprint $table)
		{
			$table->foreign('id_pengadaan_produk_retur', 'pengadaan__produk_retur_detail_ibfk_1')->references('id_pengadaan_produk_retur')->on('pengadaan__produk_retur')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_pengadaan_produk_detail', 'pengadaan__produk_retur_detail_ibfk_2')->references('id_pbb_detail')->on('pengadaan__produk_detail')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pengadaan__produk_retur_detail', function(Blueprint $table)
		{
			$table->dropForeign('pengadaan__produk_retur_detail_ibfk_1');
			$table->dropForeign('pengadaan__produk_retur_detail_ibfk_2');
		});
	}

}
