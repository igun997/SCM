<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGeraiOrderDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gerai_order_detail', function(Blueprint $table)
		{
			$table->foreign('gerai_layanan_id', 'gerai_order_detail_ibfk_1')->references('id')->on('gerai_layanan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('gerai_order_id', 'gerai_order_detail_ibfk_2')->references('id')->on('gerai_order')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gerai_order_detail', function(Blueprint $table)
		{
			$table->dropForeign('gerai_order_detail_ibfk_1');
			$table->dropForeign('gerai_order_detail_ibfk_2');
		});
	}

}
