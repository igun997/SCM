<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWncPelangganTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wnc__pelanggan', function(Blueprint $table)
		{
			$table->foreign('id_marketing', 'wnc__pelanggan_ibfk_1')->references('id_pengguna')->on('pengguna')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wnc__pelanggan', function(Blueprint $table)
		{
			$table->dropForeign('wnc__pelanggan_ibfk_1');
		});
	}

}
