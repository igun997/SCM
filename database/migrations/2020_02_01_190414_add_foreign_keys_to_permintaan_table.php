<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPermintaanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('permintaan', function(Blueprint $table)
		{
			$table->foreign('pos_id', 'permintaan_ibfk_1')->references('id_pos')->on('pos')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('permintaan', function(Blueprint $table)
		{
			$table->dropForeign('permintaan_ibfk_1');
		});
	}

}
