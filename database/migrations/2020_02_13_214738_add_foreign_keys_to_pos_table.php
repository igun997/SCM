<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pos', function(Blueprint $table)
		{
			$table->foreign('pos_id', 'pos_ibfk_1')->references('id_pos')->on('pos')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pos', function(Blueprint $table)
		{
			$table->dropForeign('pos_ibfk_1');
		});
	}

}
