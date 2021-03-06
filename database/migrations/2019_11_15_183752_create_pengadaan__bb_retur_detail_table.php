<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePengadaanBbReturDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pengadaan__bb_retur_detail', function(Blueprint $table)
		{
			$table->integer('id_pengadaan_bb_retur_detail', true);
			$table->integer('id_pengadaan_bb_detail')->index('id_pengadaan_Detail');
			$table->float('total_retur', 10, 0);
			$table->text('catatan_retur', 65535)->nullable();
			$table->string('id_pengadaan_bb_retur', 60)->index('ids_asa');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pengadaan__bb_retur_detail');
	}

}
