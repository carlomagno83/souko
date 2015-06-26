@extends('layouts.scaffold')

@section('main')

<h3>Muestra Producto</h3>

<p>{{ link_to_route('productos.index', 'Volver a la Tabla Maestra de Productos', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
				<th>Proveedor</th>
				<th>Codproducto31</th>				
				<th>Prec. compra</th>
				<th>Prec. Venta</th>
				<th>Usuario_id</th>
		</tr>
	</thead>

	<tbody>
		<tr>
					<td>{{{ $producto->provider_id }}}</td>
					<td>{{{ $producto->codproducto31 }}}</td>
					<td>{{{ $producto->preciocompra }}}</td>
					<td>{{{ $producto->precioventa }}}</td>
					<td>{{{ $producto->usuario_id }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('productos.destroy', $producto->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('productos.edit', 'Editar', array($producto->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
