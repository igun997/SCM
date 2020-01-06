<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeraiDriverTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gerai_driver', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nama', 100);
			$table->text('alamat', 65535);
			$table->string('username', 20);
			$table->string('password', 100);
			$table->integer('status')->default(0);
			$table->string('no_hp', 15);
			$table->string('pemilik_id', 60)->index('xa');
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
		Schema::drop('gerai_driver');
	}

}
