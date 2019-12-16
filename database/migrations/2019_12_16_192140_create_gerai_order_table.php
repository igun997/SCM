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
			$table->integer('status_order')->default(0);
			$table->boolean('dijemput')->nullable();
			$table->integer('gerai_driver_id')->nullable()->index('did');
			$table->integer('jarak')->nullable();
			$table->float('totalharga', 10, 0);
			$table->timestamp('dibuat')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('cLat', 100)->nullable();
			$table->string('cLng', 100)->nullable();
			$table->string('dLat', 100)->nullable();
			$table->string('dLng', 100)->nullable();
			$table->text('alamat_antar', 65535)->nullable();
			$table->text('alamat_jemput', 65535)->nullable();
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
