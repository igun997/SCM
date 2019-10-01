<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProduksiDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('produksi__detail', function(Blueprint $table)
		{
			$table->foreign('id_produksi', 'produksi__detail_ibfk_1')->references('id_produksi')->on('produksi')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_produk', 'produksi__detail_ibfk_2')->references('id_produk')->on('master__produk')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('produksi__detail', function(Blueprint $table)
		{
			$table->dropForeign('produksi__detail_ibfk_1');
			$table->dropForeign('produksi__detail_ibfk_2');
		});
	}

}
