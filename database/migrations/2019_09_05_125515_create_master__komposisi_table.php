<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasterKomposisiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('master__komposisi', function(Blueprint $table)
		{
			$table->integer('id_komposisi', true);
			$table->string('id_produk', 60)->index('id_produk');
			$table->string('id_bb', 25)->index('id_bb');
			$table->float('jumlah', 10, 0);
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
		Schema::drop('master__komposisi');
	}

}
