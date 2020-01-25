<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPengirimanDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pengiriman__detail', function(Blueprint $table)
		{
			$table->foreign('id_pengiriman', 'pengiriman__detail_ibfk_1')->references('id_pengiriman')->on('pengiriman')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_pemesanan', 'pengiriman__detail_ibfk_2')->references('id_pemesanan')->on('pemesanan')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pengiriman__detail', function(Blueprint $table)
		{
			$table->dropForeign('pengiriman__detail_ibfk_1');
			$table->dropForeign('pengiriman__detail_ibfk_2');
		});
	}

}
