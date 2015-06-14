<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipomovimientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipomovimientos', function(Blueprint $table) {
			$table->increments('id');
			$table->string('codtipomovimiento3', 3);
			$table->string('codtipomovimiento6', 6);
			$table->string('destipomovimiento', 45);
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
		Schema::drop('tipomovimientos');
	}

}
