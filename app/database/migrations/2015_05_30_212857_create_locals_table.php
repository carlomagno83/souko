<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locals', function(Blueprint $table) {
			$table->increments('id');
			$table->string('codlocal3', 3);
			$table->string('codlocal6', 6);
			$table->string('deslocal', 45);
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
		Schema::drop('locals');
	}

}
