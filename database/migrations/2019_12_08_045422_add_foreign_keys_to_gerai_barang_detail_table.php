<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGeraiBarangDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gerai_barang_detail', function(Blueprint $table)
		{
			$table->foreign('gerai_barang_id', 'gerai_barang_detail_ibfk_1')->references('id')->on('gerai_barang')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gerai_barang_detail', function(Blueprint $table)
		{
			$table->dropForeign('gerai_barang_detail_ibfk_1');
		});
	}

}
