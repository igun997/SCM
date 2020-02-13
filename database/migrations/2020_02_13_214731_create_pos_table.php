<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pos', function(Blueprint $table)
		{
			$table->integer('id_pos', true);
			$table->string('nama_pengguna');
			$table->string('cabang')->nullable();
			$table->text('alamat', 65535)->nullable();
			$table->string('username');
			$table->string('password');
			$table->boolean('status');
			$table->enum('level', array('manajer','kasir'));
			$table->integer('pos_id')->nullable()->index('as');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pos');
	}

}
