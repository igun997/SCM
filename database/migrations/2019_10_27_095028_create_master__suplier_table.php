<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasterSuplierTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('master__suplier', function(Blueprint $table)
		{
			$table->string('id_suplier', 25)->primary();
			$table->string('nama_suplier', 100);
			$table->string('no_kontak', 20);
			$table->string('email', 25);
			$table->text('alamat', 65535);
			$table->text('ket', 65535)->nullable();
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
		Schema::drop('master__suplier');
	}

}
