<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeraiKontrolTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gerai_kontrol', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('pemilik_id', 60)->index('pd');
			$table->string('mentor_id', 60)->index('md');
			$table->text('catatan_keuangan', 65535)->nullable();
			$table->text('catatan_pelayanan', 65535)->nullable();
			$table->text('catatan_barang', 65535)->nullable();
			$table->boolean('status_kontrol')->nullable()->default(0);
			$table->boolean('status_evaluasi')->nullable();
			$table->text('catatan_evaluasi', 65535)->nullable();
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
		Schema::drop('gerai_kontrol');
	}

}
