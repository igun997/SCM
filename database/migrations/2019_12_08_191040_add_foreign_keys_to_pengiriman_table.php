<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPengirimanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pengiriman', function(Blueprint $table)
		{
			$table->foreign('id_transportasi', 'pengiriman_ibfk_1')->references('id_transportasi')->on('master__transportasi')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pengiriman', function(Blueprint $table)
		{
			$table->dropForeign('pengiriman_ibfk_1');
		});
	}

}
