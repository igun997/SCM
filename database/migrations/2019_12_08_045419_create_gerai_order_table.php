<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeraiOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gerai_order', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('gerai_pelanggan_id')->index('fkpelanggan');
			$table->string('pemilik_id', 60)->index('oa');
			$table->integer('gerai_layanan_id')->index('layanan_id');
			$table->integer('status_order')->default(0);
			$table->integer('qty');
			$table->boolean('dijemput')->nullable();
			$table->integer('gerai_driver_id')->nullable()->index('did');
			$table->integer('jarak')->nullable();
			$table->float('totalharga', 10, 0);
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
		Schema::drop('gerai_order');
	}

}
