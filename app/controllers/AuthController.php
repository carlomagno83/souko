<?php
 
class AuthController extends BaseController {
 
    public function showLogin()
    {
        // Verificamos si hay sesión activa
        if (Auth::check())
        {
            // Si tenemos sesión activa mostrará la página de inicio
            return Redirect::to('/');
        }
        // Si no hay sesión activa mostramos el formulario
        return View::make('login');
    }
 
    public function postLogin()
    {
        // Obtenemos los datos del formulario
        $data = [
            'username' => Input::get('username'),
            'password' => Input::get('password')
        ];
 
        // Verificamos los datos
        if (Auth::attempt($data, Input::get('remember'))) // Como segundo parámetro pasámos el checkbox para sabes si queremos recordar la contraseña
        {
            //dd(Auth::user()->estado);
            if(Auth::user()->estado=="INA")
            {
                //dd("sale");
                return Redirect::to('logout')->with('error_message', 'Usuario Inactivo');
 
            }
            else
            {
            //borramos datos de temporales
            DB::table('entradas')->where('usuario_id', '=', Auth::user()->id )->delete();
            DB::table('devueltos')->where('usuario_id', '=', Auth::user()->id )->delete();
            DB::table('devuelves')->where('usuario_id', '=', Auth::user()->id )->delete();
            DB::table('tempos')->where('usuario_id', '=', Auth::user()->id )->delete();
            DB::table('traslados')->where('usuario_id', '=', Auth::user()->id )->delete();
            DB::table('vendidos')->where('usuario_id', '=', Auth::user()->id )->delete();

            // Si nuestros datos son correctos mostramos la página de inicio
            return Redirect::intended('/');

            }
        }
        // Si los datos no son los correctos volvemos al login y mostramos un error
        return Redirect::back()->with('error_message', 'Invalid data')->withInput();
    }
 
    public function logOut()
    {
            //borramos datos de temporales
            DB::table('entradas')->where('usuario_id', '=', Auth::user()->id )->delete();
            DB::table('devueltos')->where('usuario_id', '=', Auth::user()->id )->delete();
            DB::table('devuelves')->where('usuario_id', '=', Auth::user()->id )->delete();
            DB::table('tempos')->where('usuario_id', '=', Auth::user()->id )->delete();
            DB::table('traslados')->where('usuario_id', '=', Auth::user()->id )->delete();
            DB::table('vendidos')->where('usuario_id', '=', Auth::user()->id )->delete();
        // Cerramos la sesión
        Auth::logout();
        // Volvemos al login y mostramos un mensaje indicando que se cerró la sesión
        return Redirect::to('login')->with('error_message', 'Logged out correctly');
    }
 
}