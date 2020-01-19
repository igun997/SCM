<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProduksiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produksi', function(Blueprint $table)
		{
			$table->string('id_produksi', 60)->primary();
			$table->enum('jenis', array('perencanaan','implementasi'));
			$table->text('alasan_perencanaan', 65535)->nullable();
			$table->integer('konfirmasi_perencanaan')->default(0);
			$table->text('catatan_perencanaan', 65535)->nullable();
			$table->integer('konfirmasi_direktur')->default(0);
			$table->integer('konfirmasi_gudang')->default(0);
			$table->text('catatan_gudang', 65535)->nullable();
			$table->text('catatan_direktur', 65535)->nullable();
			$table->text('catatan_produksi', 65535)->nullable();
			$table->integer('status_produksi')->default(0);
			$table->date('tgl_kon_direktur')->nullable();
			$table->date('tgl_kon_gudang')->nullable();
			$table->date('tgl_selesai_produksi')->nullable();
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
		Schema::drop('produksi');
	}

}
