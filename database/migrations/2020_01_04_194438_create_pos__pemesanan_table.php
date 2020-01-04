<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosPemesananTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pos__pemesanan', function(Blueprint $table)
		{
			$table->integer('id_p_pemesanan', true);
			$table->integer('id_pos')->index('id_p');
			$table->integer('status_pesanan');
			$table->text('catatan_pemesanan', 65535);
			$table->integer('status_pembayaran');
			$table->float('pajak', 10, 0);
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
		Schema::drop('pos__pemesanan');
	}

}
