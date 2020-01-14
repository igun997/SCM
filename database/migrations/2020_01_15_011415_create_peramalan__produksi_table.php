<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeramalanProduksiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('peramalan__produksi', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('id_produk', 60)->index('id_pr');
			$table->float('prakira', 10, 0);
			$table->date('tgl_dibuat');
			$table->enum('jenis', array('manual','algoritma'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('peramalan__produksi');
	}

}
