<?php


class IngresoproveedorController extends BaseController {
   
    public function index()
    {

        return View::make('ingresoproveedor.createingresoproveedor');

    }
 
    public function ingreso()
    {

        //return "ingreso";
        //$documentos = $this->documento->all();
        //return View::make('documentos.ingresoproveedor', compact('documentos'));
        return View::make('ingresoproveedor.createingresoproveedor');

        //C:\xampp\htdocs\almacen\app\views\documentos\ingresoproveedor.blade.php

    }

    public function graba()
    {
        /*$tipomovimiento_id = $_POST["tipomovimiento_id"];
        $localini_id = $_POST["localini_id"];
        $localfin_id = $_POST["localfin_id"];
        $flagestado  = "ACT";
        $cantidad = $_POST["cantidad"];
        $usuario = 1;
        return $tipomovimiento_id;*/
        /*datos en duro
        $er_text =0;
        $documento_id=0;
        $tipomovimiento_id = 1;
        $localini_id = 1;
        $localfin_id = 2;
        $flagestado = 'PEN';
        $usuario_id = 1;*/

           $data = Input::all();
            return $data;

        /*  $tipomovimiento_id => Input::get('tipomovimiento_id');
        $localini_id 		=> Input::get('localini_id');
        $localfin_id 		=> Input::get('localfin_id');
        $flagestado 		=>'ACT';
        $usuario_id 		=>1;*/

        return var_dump($data);
        $results = DB::statement('CALL AddDocumentos (:tipomovimiento_id, :localini_id , :localfin_id, :flagestado, :usuario_id, @er_text , @documento_id  )',

        array(
            $tipomovimiento_id,
            $localini_id,
            $localfin_id,
            $flagestado,
            $usuario_id,

        )
        );
        $results = DB::select('Select @er_text, @documento_id');
        return var_dump($results);



        /*datos en duro
        $tipomovimiento_id = 1;
        $localini_id = 1;
        $localfin_id = 2;
        $flagestado = 'PEN';
        $usuario_id = 1;

        $db = DB::getPdo();
        $sentencia = $db->prepare("CALL AddDocumento (:tipomovimiento_id, :localini_id , :localfin_id, :flagestado, :usuario_id)");
        $sentencia->bindParam(':tipomovimiento_id', $tipomovimiento_id);
        $sentencia->bindParam(':localini_id', $localini_id);
        $sentencia->bindParam(':localfin_id', $localfin_id);
        $sentencia->bindParam(':flagestado', $flagestado);
        $sentencia->bindParam(':usuario_id', $usuario_id);

        // llamar al procedimiento almacenado
        $sentencia->execute();
        $db = null;

        $documentos = $this->documento->all();
        return $documentos;
        */

    }

}
