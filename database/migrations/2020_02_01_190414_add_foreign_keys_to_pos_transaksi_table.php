<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPosTransaksiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pos_transaksi', function(Blueprint $table)
		{
			$table->foreign('pos_register_id', 'pos_transaksi_ibfk_1')->references('id')->on('pos_register')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pos_transaksi', function(Blueprint $table)
		{
			$table->dropForeign('pos_transaksi_ibfk_1');
		});
	}

}
