<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePemesananTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pemesanan', function(Blueprint $table)
		{
			$table->string('id_pemesanan', 60)->primary();
			$table->string('id_pelanggan', 20)->index('id_pelanggan');
			$table->integer('status_pesanan')->default(0);
			$table->text('catatan_pemesanan', 65535)->nullable();
			$table->integer('status_pembayaran')->default(0);
			$table->string('bukti', 100)->nullable();
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
		Schema::drop('pemesanan');
	}

}
