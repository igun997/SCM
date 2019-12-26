<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasterPelangganTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('master__pelanggan', function(Blueprint $table)
		{
			$table->string('id_pelanggan', 20)->primary();
			$table->string('nama_pelanggan', 60);
			$table->text('alamat', 65535);
			$table->string('no_kontak', 20);
			$table->string('email', 60)->unique('email');
			$table->string('password', 100);
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
		Schema::drop('master__pelanggan');
	}

}
