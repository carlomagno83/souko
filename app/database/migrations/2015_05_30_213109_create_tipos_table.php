<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTiposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipos', function(Blueprint $table) {
			$table->increments('id');
			$table->string('codtipo3', 3);
			$table->string('codtipo6', 6);
			$table->string('destipo', 45);
			$table->integer('usuario_id');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipos');
	}

}
