@extends('layouts.scaffold')

@section('main')

<h1>All Movimientos</h1>

<table class="table table-striped ">
<thead>
<tr>
	<th>
		<form name="filtra_fecha" action="{{url('reporte-muestra')}}" method="post" enctype="application/w-www-form-urlencoded">
		  <label>Fecha Inicial:</label>
			<input type="date" name="fecha_ini_txt" step="1" min="2013-01-01" max="2050-12-31" />

		  <label>Fecha Final:</label>
			<input type="date" name="fecha_fin_txt" step="1" min="2013-01-01" max="2050-12-31" />

		  	<input type="submit" name="filtra_fecha_btn" value="Filtrar Fecha" />
		  	<input type="submit" name="baja_pdf_btn" value="Baja Pdf" />
		  	<input type="submit" name="baja_xls_btn" value="Baja Xls" />
		</form>
	</th>
</tr>

@if ($movimientos->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Movimientos_id</th>
				<th>Dcoumentos_fecha</th>
				<th>Mercaderia_id</th>
				<th>Producto_id</th>	
				<th>codProducto31</th>								
				<th>Precio Venta</th>
			</tr>
		</thead>
         
		<tbody>
			@foreach ($movimientos as $movimiento)
				<tr>
					<td>{{{ $movimiento->id }}}</td>
					<td>{{{ $movimiento->fechadocumento }}}</td>	
					<td>{{{ $movimiento->mercaderia_id }}}</td>					
					<td>{{{ $movimiento->producto_id }}}</td>
					<td>{{{ $movimiento->codproducto31 }}}</td>
					<td>{{{ $movimiento->precioventa }}}</td>

				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No hay movimientos para la fecha ingresada
@endif



@stop



