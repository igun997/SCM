<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasterTransportasiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('master__transportasi', function(Blueprint $table)
		{
			$table->string('id_transportasi', 20)->primary();
			$table->enum('jenis_transportasi', array('mobil','motor','pesawat','kapal'));
			$table->string('no_polisi', 20)->nullable();
			$table->integer('status_kendaraan')->default(1);
			$table->timestamp('tgl_register')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('master__transportasi');
	}

}
