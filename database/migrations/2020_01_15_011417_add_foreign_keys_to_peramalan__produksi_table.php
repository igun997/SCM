<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPeramalanProduksiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('peramalan__produksi', function(Blueprint $table)
		{
			$table->foreign('id_produk', 'peramalan__produksi_ibfk_1')->references('id_produk')->on('master__produk')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('peramalan__produksi', function(Blueprint $table)
		{
			$table->dropForeign('peramalan__produksi_ibfk_1');
		});
	}

}
