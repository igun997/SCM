<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosRegisterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pos_register', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('pos_id')->index('posid');
			$table->date('check_in')->nullable();
			$table->date('check_out')->nullable();
			$table->float('cash_start', 10, 0);
			$table->integer('cash_close');
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
		Schema::drop('pos_register');
	}

}
