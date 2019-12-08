<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePengadaanBbReturTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pengadaan__bb_retur', function(Blueprint $table)
		{
			$table->string('id_pengadaan_bb_retur', 60)->primary();
			$table->date('tanggal_retur');
			$table->date('tanggal_selesai')->nullable();
			$table->string('id_pengadaan_bb', 60)->index('id_pengadaan_bb_fk');
			$table->boolean('status_retur')->default(0);
			$table->boolean('konfirmasi_direktur')->default(0);
			$table->boolean('konfirmasi_pengadaan')->default(0);
			$table->text('catatan_direktur', 65535)->nullable();
			$table->text('catatan_pengadaan', 65535)->nullable();
			$table->text('catatan_gudang', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pengadaan__bb_retur');
	}

}
