<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWncOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wnc__order', function(Blueprint $table)
		{
			$table->foreign('id_pelanggan', 'wnc__order_ibfk_1')->references('id_pelanggan')->on('wnc__pelanggan')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wnc__order', function(Blueprint $table)
		{
			$table->dropForeign('wnc__order_ibfk_1');
		});
	}

}
