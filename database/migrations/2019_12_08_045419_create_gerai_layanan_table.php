<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeraiLayananTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gerai_layanan', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('pemilik_id', 60)->index('pgerai');
			$table->string('nama', 100);
			$table->float('harga', 10, 0);
			$table->string('foto', 100)->nullable();
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
		Schema::drop('gerai_layanan');
	}

}
