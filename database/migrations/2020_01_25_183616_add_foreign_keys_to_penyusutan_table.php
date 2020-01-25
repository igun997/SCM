<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPenyusutanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('penyusutan', function(Blueprint $table)
		{
			$table->foreign('id_bb', 'penyusutan_ibfk_1')->references('id_bb')->on('master__bb')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_produk', 'penyusutan_ibfk_2')->references('id_produk')->on('master__produk')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('penyusutan', function(Blueprint $table)
		{
			$table->dropForeign('penyusutan_ibfk_1');
			$table->dropForeign('penyusutan_ibfk_2');
		});
	}

}
