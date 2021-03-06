<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	//problemas para ingresar el password hasheado
	//protected $fillable = array('username', 'desusuario', 'rolusuario', 'password');

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

//modif para error de hasheado
	/*public  function setPasswordAttribute()
	{
	    $this->password = Hash::make($this->password);
	}*/

	public static $rules = array(
	              	'username' 	=> 'required',
	             	'desusuario' => 'required',
	             	'rolusuario' => 'required',
		           	//'password' => 'required'


	          );
}
