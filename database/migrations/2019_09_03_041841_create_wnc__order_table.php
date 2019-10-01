<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWncOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wnc__order', function(Blueprint $table)
		{
			$table->string('id_order', 60)->primary();
			$table->string('nama_pemesan', 60)->nullable();
			$table->string('id_pelanggan', 60)->nullable()->index('id_pelanggan');
			$table->integer('status_order')->default(0);
			$table->integer('dijemput')->default(0);
			$table->integer('diantar')->default(0);
			$table->timestamp('tg_order')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wnc__order');
	}

}
