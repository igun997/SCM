<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePengaturanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pengaturan', function(Blueprint $table)
		{
			$table->integer('id_pengaturan', true);
			$table->text('meta_key', 65535);
			$table->text('meta_value', 65535);
			$table->timestamp('valid')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pengaturan');
	}

}
