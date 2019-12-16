<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeraiOrderDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gerai_order_detail', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('gerai_order_id')->index('as');
			$table->integer('gerai_layanan_id')->index('asa');
			$table->integer('qty')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gerai_order_detail');
	}

}
