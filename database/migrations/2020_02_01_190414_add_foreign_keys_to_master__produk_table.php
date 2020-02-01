<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMasterProdukTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('master__produk', function(Blueprint $table)
		{
			$table->foreign('id_satuan', 'master__produk_ibfk_1')->references('id_satuan')->on('master__satuan')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('master__produk', function(Blueprint $table)
		{
			$table->dropForeign('master__produk_ibfk_1');
		});
	}

}
