<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePengirimanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pengiriman', function(Blueprint $table)
		{
			$table->string('id_pengiriman', 60)->primary();
			$table->string('id_transportasi', 20)->index('id_trasport');
			$table->date('tgl_pengiriman');
			$table->date('tgl_kembali')->nullable();
			$table->integer('status_pengiriman')->nullable()->default(0);
			$table->string('kontak_pengemudi', 20);
			$table->string('nama_pengemudi', 60);
			$table->text('catatan_khusus', 65535)->nullable();
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
		Schema::drop('pengiriman');
	}

}
