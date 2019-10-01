<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePenggunaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pengguna', function(Blueprint $table)
		{
			$table->string('id_pengguna', 60)->primary();
			$table->string('nama_pengguna', 60);
			$table->string('no_kontak', 20);
			$table->text('alamat', 65535);
			$table->enum('level', array('direktur','produksi','gudang','pengadaan'));
			$table->integer('status')->default(1);
			$table->string('email', 60);
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
		Schema::drop('pengguna');
	}

}
