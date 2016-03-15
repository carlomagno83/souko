<?php

class MantenimientobdController extends BaseController 
{



  	public function mantenimientobd()
  	{


            DB::select("OPTIMIZE TABLE `colors`, `devueltos`, `devuelves`, `documentos`, `entradas`, `estados`, `locals`, `marcas`, `materials`, `mercaderias`, `migrations`, `modelos`, `movimientos`, `productos`, `providers`, `rangos`, `tallas`, `tempos`, `tipomovimientos`, `tipos`, `traslados`, `users`, `vendidos`");
            $productos = Producto::find(0);
    		return View::make('productos.index')->with('productos',$productos)->withErrors(['Mantenimiento de Base de datos ejecutada.... ']) ;
  	}




}	
?>
