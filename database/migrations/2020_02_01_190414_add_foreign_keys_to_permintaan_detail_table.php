<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPermintaanDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('permintaan_detail', function(Blueprint $table)
		{
			$table->foreign('id_produk', 'permintaan_detail_ibfk_1')->references('id_produk')->on('master__produk')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('permintaan_id', 'permintaan_detail_ibfk_2')->references('id')->on('permintaan')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('permintaan_detail', function(Blueprint $table)
		{
			$table->dropForeign('permintaan_detail_ibfk_1');
			$table->dropForeign('permintaan_detail_ibfk_2');
		});
	}

}
