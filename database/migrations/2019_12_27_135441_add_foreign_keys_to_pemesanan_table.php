<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPemesananTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pemesanan', function(Blueprint $table)
		{
			$table->foreign('id_pelanggan', 'pemesanan_ibfk_1')->references('id_pelanggan')->on('master__pelanggan')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pemesanan', function(Blueprint $table)
		{
			$table->dropForeign('pemesanan_ibfk_1');
		});
	}

}
