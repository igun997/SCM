<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePengadaanBbTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pengadaan__bb', function(Blueprint $table)
		{
			$table->string('id_pengadaan_bb', 60)->primary();
			$table->string('id_suplier', 25)->index('id_suplier');
			$table->integer('status_pengadaan')->default(0);
			$table->date('tgl_diterima')->nullable();
			$table->timestamp('tgl_register')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('konfirmasi_direktur')->default(0);
			$table->integer('konfirmasi_gudang')->default(0);
			$table->text('catatan_gudang', 65535)->nullable();
			$table->text('catatan_pengadaan', 65535)->nullable();
			$table->text('catatan_direktur', 65535)->nullable();
			$table->date('perkiraan_tiba')->nullable();
			$table->date('tgl_perubahan')->nullable();
			$table->integer('dibaca_pengadaan')->nullable();
			$table->integer('dibaca_direktur')->nullable();
			$table->integer('dibaca_gudang')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pengadaan__bb');
	}

}
