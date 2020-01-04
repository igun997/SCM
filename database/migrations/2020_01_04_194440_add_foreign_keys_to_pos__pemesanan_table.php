<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPosPemesananTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pos__pemesanan', function(Blueprint $table)
		{
			$table->foreign('id_pos', 'pos__pemesanan_ibfk_1')->references('id_pos')->on('pos')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pos__pemesanan', function(Blueprint $table)
		{
			$table->dropForeign('pos__pemesanan_ibfk_1');
		});
	}

}
