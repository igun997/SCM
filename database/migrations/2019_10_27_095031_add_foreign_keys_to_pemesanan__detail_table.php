<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPemesananDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pemesanan__detail', function(Blueprint $table)
		{
			$table->foreign('id_pemesanan', 'pemesanan__detail_ibfk_1')->references('id_pemesanan')->on('pemesanan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_produk', 'pemesanan__detail_ibfk_2')->references('id_produk')->on('master__produk')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pemesanan__detail', function(Blueprint $table)
		{
			$table->dropForeign('pemesanan__detail_ibfk_1');
			$table->dropForeign('pemesanan__detail_ibfk_2');
		});
	}

}
