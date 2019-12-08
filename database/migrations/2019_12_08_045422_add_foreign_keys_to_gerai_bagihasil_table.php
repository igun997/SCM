<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGeraiBagihasilTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gerai_bagihasil', function(Blueprint $table)
		{
			$table->foreign('mentor_id', 'gerai_bagihasil_ibfk_1')->references('id_pengguna')->on('pengguna')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('pemilik_id', 'gerai_bagihasil_ibfk_2')->references('id_pengguna')->on('pengguna')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gerai_bagihasil', function(Blueprint $table)
		{
			$table->dropForeign('gerai_bagihasil_ibfk_1');
			$table->dropForeign('gerai_bagihasil_ibfk_2');
		});
	}

}
