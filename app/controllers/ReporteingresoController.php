<?php

class ReporteingresoController extends BaseController {



	public function index()
	{
		$movimientos = new Movimiento;
		// $movimientos = $movimientos->all();
	
		$movimientos = $movimientos->join('mercaderias','movimientos.mercaderia_id','=','mercaderias.id')
								   ->join('productos','mercaderias.producto_id','=','productos.id')
                              ->select('movimientos.id',
                                       'movimientos.mercaderia_id',
                                       'mercaderias.producto_id',
                                       'productos.codproducto31',
                                       'mercaderias.precioventa')
                              ->orderBy('movimientos.id', 'asc')
                              ->get();
		//dd($movimientos);
		return View::make('reporteingreso.reporteingreso')->with('movimientos',$movimientos);
	}

	public function repexcel()
	{
		$movimientos = new Movimiento;
		// $movimientos = $movimientos->all();
	
		$movimientos = $movimientos->join('mercaderias','movimientos.mercaderia_id','=','mercaderias.id')
								   ->join('productos','mercaderias.producto_id','=','productos.id')
                              ->select('movimientos.id',
                                       'movimientos.mercaderia_id',
                                       'mercaderias.producto_id',
                                       'productos.codproducto31',
                                       'mercaderias.precioventa')
                              ->orderBy('movimientos.id', 'asc')
                              ->get();
		
		//return View::make('repexcel',compact('movimientos'));
	}


	public function excel()
	{
		/*
		return View::make('hello');
		*/
		\Excel::create('1er apl', function($excel)
		{
			$excel->sheet('Sheetname', function($sheet)
			{
				$data = [];
				array_push($data, array('augusto','miyagi'));
				$sheet->fromarray($data, null, 'A5',false,false);
			});
		})->download('xls');
	}

	public function movimiento()
	{
		$input = Input::all();
		return $input;
		
		\Excel::create('1er apl', function($excel)
		{
			$excel->sheet('Sheetname', function($sheet)
			{
				$movimientos = new Movimiento;
				$movimientos = $movimientos->join('mercaderias','movimientos.mercaderia_id','=','mercaderias.id')
								           ->join('productos','mercaderias.producto_id','=','productos.id')
                                           ->select('movimientos.id',
                                       				'movimientos.mercaderia_id',
                                       				'mercaderias.producto_id',
                                       				'productos.codproducto31',
                                       				'mercaderias.precioventa')
                              				->orderBy('movimientos.id', 'asc')
                              				->get();
				$sheet->fromArray($movimientos);
			});
		})->download('xls');	
	}

	public function movimientop()
	{
		
		\Excel::create('1er apl', function($excel)
		{
			$excel->sheet('Sheetname', function($sheet)
			{
				$movimientos = new Movimiento;
				$movimientos = $movimientos->join('mercaderias','movimientos.mercaderia_id','=','mercaderias.id')
								           ->join('productos','mercaderias.producto_id','=','productos.id')
                                           ->select('movimientos.id',
                                       				'movimientos.mercaderia_id',
                                       				'mercaderias.producto_id',
                                       				'productos.codproducto31',
                                       				'mercaderias.precioventa')
                              				->orderBy('movimientos.id', 'asc')
                              				->get();
				$sheet->fromArray($movimientos);
			});
		})->download('pdf');	
	}


	public function excel1()
	{
		/*
		return View::make('hello');
		*/

		\Excel::create('1er apl', function($excel)
		{
			$excel->sheet('Sheetname', function($sheet)
			{
				$data = [];
				array_push($data, array('augusto','miyagi'));
				$sheet->fromArray($data);
			});
		})->download('xls');
	}


}	
?>
