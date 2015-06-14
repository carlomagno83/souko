<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
        User::create(array(
            'username'  => 'ADMIN3',
            'desusuario'     => 'NOMBRE ADMINISTRADOR3',
            'rolusuario'=> 'ADMIN',
            'password' => Hash::make('123456'), // Hash::make() nos va generar una cadena con nuestra contraseña encriptada
    		'usuario_id'=> 1,
        ));
    }    
}
