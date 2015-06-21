<?php


class IngresoproveedorController extends BaseController
{
   
    public function index()
    {

        $movimientos = Movimiento::all();
        return View::make('ingresoproveedor.index')->with('movimientos',$movimientos);

    }

    public function create()
    {

        //Si hay filtros
        if(Input::get('marca_id')>0)
            $productos = Producto::where('marca_id',Input::get('marca_id'));

        if(Input::get('tipo_id')>0)
            $productos = Producto::where('tipo_id',Input::get('tipo_id'));

        if(Input::get('modelo_id')>0)
            $productos = Producto::where('tipo_id',Input::get('tipo_id'));

        if(Input::get('color_id')>0)
            $productos = Producto::where('tipo_id',Input::get('tipo_id'));

        if(Input::get('material_id')>0)
            $productos = Producto::where('tipo_id',Input::get('tipo_id'));

        if(Input::get('rango_id')>0)
            $productos = Producto::where('tipo_id',Input::get('tipo_id'));

        if(Input::get('talla_id')>0)
            $productos = Producto::where('tipo_id',Input::get('tipo_id'));


        if(!isset($productos))
            $productos = Producto::all();//Si no hay filtros
        else
            $productos = $productos->get();//Trae filtos concatenados


        return View::make('ingresoproveedor.create')->with('productos',$productos);

    }


    public function store()
    {

        $data = Input::all();

        $documento_id = $this->saveDocumento(Input::get('tipomovimiento_id'));

        foreach($data as $key=>$value){

            if($key=='producto_id'){

                foreach($value as $key2=>$producto_id){

                    if($data['cantidad'][$key2]>0) {

                        for ($i = 1; $i <= $data['cantidad'][$key2]; $i++) {

                            $mercaderia_id = $this->saveMercaderia($producto_id);
                            $this->saveMovimientos($mercaderia_id,$documento_id);

                        }

                    }

                }

            }

        }

        return Redirect::to('ingresos-proveedor');

    }

    private function saveDocumento($tipo_movimiento_id)
    {

        $documento = new Documento();
        $documento->tipomovimiento_id = $tipo_movimiento_id;
        $documento->fechadocumento = date('Y-m-d');
        $documento->usuario_id = 1;
        $documento->flagestado = 'ACT';
        $documento->localini_id = 1;
        $documento->localfin_id = 1;
        $documento->save();
        return $documento->id;
    }

    private function saveMercaderia($producto_id)
    {

        $mercaderia = new Mercaderia();
        $mercaderia->producto_id = $producto_id;
        $mercaderia->local_id = 1;
        $mercaderia->estado = 'ACT';
        $mercaderia->preciocompra = 60;
        $mercaderia->precioventa = 90;
        $mercaderia->usuario_id = 1;
        $mercaderia->save();
        return $mercaderia->id;
    }


    private function saveMovimientos($mercaderia_id,$documento_id)
    {

        $movimiento = new Movimiento();
        $movimiento->mercaderia_id = $mercaderia_id;
        $movimiento->documento_id = $documento_id;
        $movimiento->save();

    }

}
