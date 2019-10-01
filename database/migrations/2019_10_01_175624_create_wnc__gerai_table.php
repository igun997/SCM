<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWncGeraiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wnc__gerai', function(Blueprint $table)
		{
			$table->string('id_gerai', 60)->primary();
			$table->string('nama_gerai', 60);
			$table->text('alamat', 65535)->nullable();
			$table->string('id_pemilik', 60)->index('id_pemilik');
			$table->string('id_mentor', 60)->index('id_mentor');
			$table->integer('status_gerai')->default(1);
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
		Schema::drop('wnc__gerai');
	}

}
