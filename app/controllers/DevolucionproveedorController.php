<?php

class DevolucionproveedorController extends BaseController {

	public function ingreso()
	{
		//return "ingreso";
		//$documentos = $this->documento->all();
		//return View::make('documentos.ingresoproveedor', compact('documentos'));
		return View::make('devolucionproveedor.devolucionproveedor');

		//C:\xampp\htdocs\almacen\app\views\documentos\ingresoproveedor.blade.php
	}

	/* modificar public function graba()
	{

		$tipomovimiento_id = 1;
		$localini_id = 10;
		$localfin_id = 25;
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
		$documentos = new Documento;
		$documentos = $documentos->all();
		return $documentos; 
		
	}*/
}	
?>
