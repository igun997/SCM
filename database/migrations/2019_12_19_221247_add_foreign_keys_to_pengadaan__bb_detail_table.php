<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPengadaanBbDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pengadaan__bb_detail', function(Blueprint $table)
		{
			$table->foreign('id_bb', 'pengadaan__bb_detail_ibfk_1')->references('id_bb')->on('master__bb')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_pengadaan_bb', 'pengadaan__bb_detail_ibfk_2')->references('id_pengadaan_bb')->on('pengadaan__bb')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pengadaan__bb_detail', function(Blueprint $table)
		{
			$table->dropForeign('pengadaan__bb_detail_ibfk_1');
			$table->dropForeign('pengadaan__bb_detail_ibfk_2');
		});
	}

}
