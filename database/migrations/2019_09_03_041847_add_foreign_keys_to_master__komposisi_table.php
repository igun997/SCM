<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMasterKomposisiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('master__komposisi', function(Blueprint $table)
		{
			$table->foreign('id_bb', 'master__komposisi_ibfk_1')->references('id_bb')->on('master__bb')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('master__komposisi', function(Blueprint $table)
		{
			$table->dropForeign('master__komposisi_ibfk_1');
		});
	}

}
