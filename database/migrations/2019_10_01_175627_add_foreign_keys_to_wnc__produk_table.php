<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWncProdukTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wnc__produk', function(Blueprint $table)
		{
			$table->foreign('id_gerai', 'wnc__produk_ibfk_1')->references('id_gerai')->on('wnc__gerai')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wnc__produk', function(Blueprint $table)
		{
			$table->dropForeign('wnc__produk_ibfk_1');
		});
	}

}
