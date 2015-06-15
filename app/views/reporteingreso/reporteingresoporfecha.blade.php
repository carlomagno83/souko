@extends('layouts.scaffold')

@section('main')

<h3>Reporte de ingresos por fechas</h3>

<div class="row">
    <div class="col-lg-3">
        <div class="input-group">
            <span class="input-group-addon" id="documento_id">Fecha Inicio</span>
            <input type="text" name="fechaini" class="form-control" aria-describedby="basic-addon1">
        </div>
    </div><!-- /.col-lg-6 -->

     <div class="col-lg-3">
        <div class="input-group">
            <span class="input-group-addon" id="documento_id">Fecha Fin</span>
            <input type="text" name="fechafin" class="form-control" aria-describedby="basic-addon1">
        </div>
    </div><!-- /.col-lg-6 -->

    <div class="col-lg-3">
        {{ Form::submit('Ingrese rango de fechas', array('class' => 'btn btn-info')) }}    
    </div><!-- /.col-lg-6 -->
</div><!-- /.row -->



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
