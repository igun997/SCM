<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosBarangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pos__barang', function(Blueprint $table)
		{
			$table->integer('id_pb', true);
			$table->string('id_produk', 60)->index('id_as');
			$table->integer('id_pos')->index('sa');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pos__barang');
	}

}
