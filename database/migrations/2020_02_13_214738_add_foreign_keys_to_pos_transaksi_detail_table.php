<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPosTransaksiDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pos_transaksi_detail', function(Blueprint $table)
		{
			$table->foreign('pos_barang_id', 'pos_transaksi_detail_ibfk_1')->references('id')->on('pos_barang')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('pos_transaksi_id', 'pos_transaksi_detail_ibfk_2')->references('id')->on('pos_transaksi')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pos_transaksi_detail', function(Blueprint $table)
		{
			$table->dropForeign('pos_transaksi_detail_ibfk_1');
			$table->dropForeign('pos_transaksi_detail_ibfk_2');
		});
	}

}
