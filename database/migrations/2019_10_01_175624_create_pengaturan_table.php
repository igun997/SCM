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
			$table->float('keuntungan_ppn', 10, 0)->nullable();
			$table->float('keuntungan_mentor', 10, 0)->nullable();
			$table->float('keuntungan_marketing', 10, 0)->nullable();
			$table->float('keuntungan_pusat', 10, 0)->nullable();
			$table->float('kentungan_mitra', 10, 0)->nullable();
			$table->integer('keuntungan_produksi')->nullable();
			$table->float('keuntungan_tukang', 10, 0)->nullable();
			$table->date('tgl_perubahan')->nullable();
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
