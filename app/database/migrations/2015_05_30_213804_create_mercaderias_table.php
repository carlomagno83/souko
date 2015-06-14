<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMercaderiasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mercaderias', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('producto_id');
			$table->integer('mercaderiacambio_id');
			$table->integer('local_id');
			$table->string('estado', 3);
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
		Schema::drop('mercaderias');
	}

}
