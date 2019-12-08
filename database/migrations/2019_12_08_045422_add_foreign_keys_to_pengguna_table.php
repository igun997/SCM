<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPenggunaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pengguna', function(Blueprint $table)
		{
			$table->foreign('pengguna_id', 'pengguna_ibfk_1')->references('id_pengguna')->on('pengguna')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pengguna', function(Blueprint $table)
		{
			$table->dropForeign('pengguna_ibfk_1');
		});
	}

}
