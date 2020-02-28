<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShopeeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shopee', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 200);
			$table->bigInteger('shop_id');
			$table->string('status', 20);
			$table->integer('time_created');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shopee');
	}

}
