
<?php

class ReporteingresoController extends BaseController {

	public function Datos($fecha_ini, $fecha_fin)
	{
	/*
	funcion que devuelve los datos para generar el reporte
	se usa query builder
	http://laravel.com/docs/4.2/queries
    http://www.anerbarrena.com/date-input-html5-2829/
	getIndex = muestra resultado total de registros

	*/
		
		$movimientos = new Movimiento;
		$movimientos = $movimientos->join('mercaderias','movimientos.mercaderia_id','=','mercaderias.id')
								   ->join('productos','mercaderias.producto_id','=','productos.id')
								   ->join('documentos', 'movimientos.documento_id','=','documentos.id')
								   ->where("documentos.fechadocumento",">=", "$fecha_ini")
								   ->where("documentos.fechadocumento","<=", "$fecha_fin")
								   //->where("documentos.tipomovimiento_id", "=", 1)
                              	   ->select('movimientos.id',
                              	   			'documentos.fechadocumento',
                              	   	        'movimientos.mercaderia_id',
                                            'mercaderias.producto_id',
                                            'productos.codproducto31',
                                            'mercaderias.precioventa')
                              	   ->orderBy('movimientos.id', 'asc')
                                   ->get();		
        return $movimientos;                      
	}


	public function getmuestra()
	{
		//dd($data);
		if(isset($_POST["filtra_fecha_btn"]))
		{

			$fecha_ini = $_POST["fecha_ini_txt"];
			$fecha_fin = $_POST["fecha_fin_txt"];
			$movimientos = $this->Datos($fecha_ini ,$fecha_fin);
			return View::make('reporteingreso.reporteingreso',compact('movimientos'));

			}elseif(isset($_POST["baja_pdf_btn"]))
			{
				$fecha_ini = $_POST["fecha_ini_txt"];
				$fecha_fin = $_POST["fecha_fin_txt"];
				$movimientos = new Movimiento;
				$movimientos = $this->Datos($fecha_ini ,$fecha_fin);
				$data = array('movimientos'=>$movimientos);
				$pdf = PDF::loadView('reporteingreso.reporteingresopdf',$data);
				return $pdf->download('invoice.pdf');
				}elseif(isset($_POST["baja_xls_btn"]))
				{
					Excel::create('1er_apl', function($excel)
					{
						$excel->sheet('1ra_hoja', function($sheet)
						{
							$fecha_ini = $_POST["fecha_ini_txt"];
							$fecha_fin = $_POST["fecha_fin_txt"];
							$movimientos = new Movimiento;
							$movimientos = $this->Datos($fecha_ini ,$fecha_fin);
							$sheet->fromArray($movimientos);
						});
					})->download('xlsx');
					}elseif(empty(isset($_GET["filtra_fecha_btn"])))

					{
						$fecha_ini = date("Y-m-d");
						$fecha_fin = date("Y-m-d");			
						$movimientos = $this->Datos($fecha_ini ,$fecha_fin);
						return View::make('reporteingreso.reporteingreso',compact('movimientos'));	
					}
	}
}
/*
		if(isset($_GET["filtra_fecha_btn"]))
		{
			$fecha_ini = $_GET["fecha_ini_txt"];
			$fecha_fin = $_GET["fecha_fin_txt"];
		}else 
		{
			$fecha_ini = date("Y-m-d");
			$fecha_fin = date("Y-m-d");
		}
		
		
		
		$input = Input::all();
		return $input;
		$movimientos = $movimientos->all();
		return View::make('repexcel',compact('movimientos'));
		
	}

	public function obtenerXls()
	{
		
		Excel::create('1er_apl', function($excel)
		{
			$excel->sheet('1ra_hoja', function($sheet)
			{
				
				$fecha_ini = "2015-06-20";
				$fecha_fin = "2015-06-20";
				$movimientos = new Movimiento;
				$movimientos = $this->Datos($fecha_ini ,$fecha_fin);
				
				//$movimientos=[];
				//array_push($movimientos, array('augusto','miyagi'));
				
				$sheet->fromArray($movimientos);
			});
		})->download('xlsx');	
	}

	public function obtenerPdf()
	{
		//return $para;
		$fecha_ini = "2015-06-20";
		$fecha_fin = "2015-06-20";
		$movimientos = new Movimiento;
		$movimientos = $this->Datos($fecha_ini ,$fecha_fin);
		$data = array('movimientos'=>$movimientos);
		$pdf = PDF::loadView('repexcelpdf',$data);
		return $pdf->download('invoice.pdf');			
	}
}
*/
?>