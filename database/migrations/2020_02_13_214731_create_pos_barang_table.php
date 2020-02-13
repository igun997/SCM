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
		Schema::create('pos_barang', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('pos_id')->index('pos_id');
			$table->string('id_produk', 60)->index('id_produk');
			$table->float('stok', 10, 0);
			$table->float('harga', 10, 0);
			$table->float('sale', 10, 0)->default(0);
			$table->date('tgl_update')->nullable();
			$table->timestamp('tgl_register')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pos_barang');
	}

}
