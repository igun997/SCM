<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeraiBarangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gerai_barang', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nama_barang', 100);
			$table->text('deskripsi', 65535);
			$table->string('pemilik_id', 60)->index('pd');
			$table->string('mentor_id', 60)->index('md');
			$table->timestamp('dibuat')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gerai_barang');
	}

}
