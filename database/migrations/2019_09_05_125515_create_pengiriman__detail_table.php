<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePengirimanDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pengiriman__detail', function(Blueprint $table)
		{
			$table->integer('id_pd', true);
			$table->string('id_pengiriman', 60)->index('id_pengiriman');
			$table->string('id_pemesanan', 60)->index('id_pemesanan');
			$table->text('alamat_tujuan', 65535)->nullable();
			$table->text('catatan_khusus', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pengiriman__detail');
	}

}
