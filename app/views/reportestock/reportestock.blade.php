@extends('layouts.scaffold')

@section('main')

<h1>All Movimientos</h1>

<table class="table table-striped ">
<thead>
<tr>
	<th>{{ Form::text('fechaIni', Input::old('fechaIni'), array('class'=>'form-control')) }}</th>
	<th>{{ Form::text('fechaFin', Input::old('fechaFin'), array('class'=>'form-control')) }}</th>
	<th>
<p>{{ link_to_action('HomeController@movimiento', 'Filtro XLS', null, array('class' => 'btn btn-lg btn-success')) }}</p>
	</th>
<th>
<p>{{ link_to_action('HomeController@movimientop', 'Reporte PDF', null, array('class' => 'btn btn-lg btn-success')) }}</p>
</th>
<th>
<p>{{ link_to_action('HomeController@movimiento', 'Reporte Excel', null, array('class' => 'btn btn-lg btn-success')) }}</p>
</th>
</tr>

@if ($movimientos->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Movimientos_id</th>
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
					<td>{{{ $movimiento->mercaderia_id }}}</td>					
					<td>{{{ $movimiento->producto_id }}}</td>
					<td>{{{ $movimiento->codproducto31 }}}</td>
					<td>{{{ $movimiento->precioventa }}}</td>

				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no movimientos
@endif

@stop
