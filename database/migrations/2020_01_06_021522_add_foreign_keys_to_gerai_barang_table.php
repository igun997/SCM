<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGeraiBarangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gerai_barang', function(Blueprint $table)
		{
			$table->foreign('mentor_id', 'gerai_barang_ibfk_1')->references('id_pengguna')->on('pengguna')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('pemilik_id', 'gerai_barang_ibfk_2')->references('id_pengguna')->on('pengguna')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_produk', 'gerai_barang_ibfk_3')->references('id_produk')->on('master__produk')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gerai_barang', function(Blueprint $table)
		{
			$table->dropForeign('gerai_barang_ibfk_1');
			$table->dropForeign('gerai_barang_ibfk_2');
			$table->dropForeign('gerai_barang_ibfk_3');
		});
	}

}
