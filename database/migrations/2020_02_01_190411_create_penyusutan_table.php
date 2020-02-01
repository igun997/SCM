<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePenyusutanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('penyusutan', function(Blueprint $table)
		{
			$table->string('kode_penyusutan', 25)->primary();
			$table->float('total_barang', 10, 0)->default(0);
			$table->float('estimasi_kerugian', 10, 0)->default(0);
			$table->text('ket', 65535)->nullable();
			$table->string('bukti', 100)->nullable();
			$table->string('id_bb', 25)->nullable()->index('in');
			$table->string('id_produk', 25)->nullable()->index('ip');
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
		Schema::drop('penyusutan');
	}

}
