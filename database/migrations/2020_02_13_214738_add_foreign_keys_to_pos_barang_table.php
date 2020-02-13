<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPosBarangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pos_barang', function(Blueprint $table)
		{
			$table->foreign('pos_id', 'pos_barang_ibfk_1')->references('id_pos')->on('pos')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_produk', 'pos_barang_ibfk_2')->references('id_produk')->on('master__produk')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pos_barang', function(Blueprint $table)
		{
			$table->dropForeign('pos_barang_ibfk_1');
			$table->dropForeign('pos_barang_ibfk_2');
		});
	}

}
