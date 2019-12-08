<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeraiBarangDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gerai_barang_detail', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->enum('jenis', array('keluar','masuk'));
			$table->float('qty', 10, 0);
			$table->boolean('konf_pemilik')->default(0);
			$table->date('tgl_konf')->nullable();
			$table->timestamp('dibuat')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('gerai_barang_id')->index('sa');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gerai_barang_detail');
	}

}
