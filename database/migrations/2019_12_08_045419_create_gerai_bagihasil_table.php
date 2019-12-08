<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeraiBagihasilTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gerai_bagihasil', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('pemilik_id', 60)->index('pd');
			$table->string('mentor_id', 60)->index('md');
			$table->float('pemilik', 10, 0);
			$table->float('pusat', 10, 0);
			$table->float('totalkotor', 10, 0);
			$table->float('totalpesanan', 10, 0);
			$table->string('periode', 60);
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
		Schema::drop('gerai_bagihasil');
	}

}
