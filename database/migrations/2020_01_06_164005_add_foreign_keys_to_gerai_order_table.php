<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGeraiOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gerai_order', function(Blueprint $table)
		{
			$table->foreign('gerai_driver_id', 'gerai_order_ibfk_1')->references('id')->on('gerai_driver')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('gerai_pelanggan_id', 'gerai_order_ibfk_3')->references('id')->on('gerai_pelanggan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('pemilik_id', 'gerai_order_ibfk_4')->references('id_pengguna')->on('pengguna')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('gerai_driver_id', 'gerai_order_ibfk_5')->references('id')->on('gerai_driver')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('gerai_driver_id_antar', 'gerai_order_ibfk_6')->references('id')->on('gerai_driver')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gerai_order', function(Blueprint $table)
		{
			$table->dropForeign('gerai_order_ibfk_1');
			$table->dropForeign('gerai_order_ibfk_3');
			$table->dropForeign('gerai_order_ibfk_4');
			$table->dropForeign('gerai_order_ibfk_5');
			$table->dropForeign('gerai_order_ibfk_6');
		});
	}

}
