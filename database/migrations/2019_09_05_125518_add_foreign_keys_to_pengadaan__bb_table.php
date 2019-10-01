<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPengadaanBbTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pengadaan__bb', function(Blueprint $table)
		{
			$table->foreign('id_suplier', 'pengadaan__bb_ibfk_2')->references('id_suplier')->on('master__suplier')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pengadaan__bb', function(Blueprint $table)
		{
			$table->dropForeign('pengadaan__bb_ibfk_2');
		});
	}

}
