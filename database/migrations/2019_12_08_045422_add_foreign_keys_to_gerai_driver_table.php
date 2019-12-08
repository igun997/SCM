<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGeraiDriverTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gerai_driver', function(Blueprint $table)
		{
			$table->foreign('pemilik_id', 'gerai_driver_ibfk_1')->references('id_pengguna')->on('pengguna')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gerai_driver', function(Blueprint $table)
		{
			$table->dropForeign('gerai_driver_ibfk_1');
		});
	}

}
