<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosTransaksiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pos_transaksi', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nama_pelanggan', 200);
			$table->date('tgl_transaksi');
			$table->enum('status', array('tahan','tunggu','batal','selesai'));
			$table->float('total_pembayaran', 10, 0);
			$table->float('total_bayar', 10, 0)->default(0);
			$table->float('kembalian', 10, 0)->default(0);
			$table->integer('pos_register_id')->index('pos_register_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pos_transaksi');
	}

}
