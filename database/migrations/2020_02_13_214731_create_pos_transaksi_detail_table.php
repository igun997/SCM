<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosTransaksiDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pos_transaksi_detail', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('pos_transaksi_id')->index('pos_trx_id');
			$table->integer('pos_barang_id')->index('pos_brg_id');
			$table->float('jumlah', 10, 0);
			$table->float('harga', 10, 0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pos_transaksi_detail');
	}

}
