<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMasterBbTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('master__bb', function(Blueprint $table)
		{
			$table->foreign('id_satuan', 'master__bb_ibfk_1')->references('id_satuan')->on('master__satuan')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('master__bb', function(Blueprint $table)
		{
			$table->dropForeign('master__bb_ibfk_1');
		});
	}

}
