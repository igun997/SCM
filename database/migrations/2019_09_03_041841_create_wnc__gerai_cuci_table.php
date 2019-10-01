<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWncGeraiCuciTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wnc__gerai_cuci', function(Blueprint $table)
		{
			$table->string('id_gc', 60);
			$table->integer('id_tukangcuci')->index('id_tukangcuci');
			$table->integer('status')->default(1);
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
		Schema::drop('wnc__gerai_cuci');
	}

}
