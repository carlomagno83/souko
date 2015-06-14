<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTallasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tallas', function(Blueprint $table) {
			$table->increments('id');
			$table->string('codtalla3', 3);
			$table->string('codtalla6', 6);
			$table->string('destalla', 45);
			$table->integer('usuario_id');
			$table->integer('rango_id');
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
		Schema::drop('tallas');
	}

}
