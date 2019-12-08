<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPosPemesananDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pos__pemesanan_detail', function(Blueprint $table)
		{
			$table->foreign('id_p_pemesanan', 'pos__pemesanan_detail_ibfk_1')->references('id_p_pemesanan')->on('pos__pemesanan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_produk', 'pos__pemesanan_detail_ibfk_2')->references('id_produk')->on('master__produk')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pos__pemesanan_detail', function(Blueprint $table)
		{
			$table->dropForeign('pos__pemesanan_detail_ibfk_1');
			$table->dropForeign('pos__pemesanan_detail_ibfk_2');
		});
	}

}
