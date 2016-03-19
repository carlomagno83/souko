<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('ColorsTableSeeder');
		$this->call('LocalsTableSeeder');
		$this->call('EstadosTableSeeder');
		$this->call('MarcasTableSeeder');
		$this->call('TiposTableSeeder');
		$this->call('ModelosTableSeeder');
		$this->call('MaterialsTableSeeder');
		$this->call('RangosTableSeeder');
		$this->call('TallasTableSeeder');
		$this->call('TipomovimientosTableSeeder');
		$this->call('DocumentosTableSeeder');
		$this->call('MercaderiasTableSeeder');
		$this->call('MovimientosTableSeeder');
		$this->call('ProductosTableSeeder');
		$this->call('UsersTableSeeder');
	}

}
