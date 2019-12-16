<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeraiPelangganTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gerai_pelanggan', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nama', 100);
			$table->integer('jk');
			$table->text('alamat', 65535);
			$table->string('email', 100);
			$table->string('password', 100);
			$table->string('no_hp', 15);
			$table->integer('status')->default(0);
			$table->string('lat', 50)->nullable();
			$table->string('lng', 50)->nullable();
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
		Schema::drop('gerai_pelanggan');
	}

}
