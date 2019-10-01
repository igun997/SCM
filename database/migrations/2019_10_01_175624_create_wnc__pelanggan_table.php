<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWncPelangganTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wnc__pelanggan', function(Blueprint $table)
		{
			$table->string('id_pelanggan', 60)->primary();
			$table->string('nama_pelanggan', 70);
			$table->enum('jk', array('laki-laki','perempuan'));
			$table->text('alamat', 65535)->nullable();
			$table->string('no_kontak', 20);
			$table->string('pekerjaan', 100);
			$table->string('id_marketing', 60)->nullable()->index('id_marketing');
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
		Schema::drop('wnc__pelanggan');
	}

}
