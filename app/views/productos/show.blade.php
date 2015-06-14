@extends('layouts.scaffold')

@section('main')

<h1>Show Producto</h1>

<p>{{ link_to_route('productos.index', 'Return to All productos', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Marca_id</th>
				<th>Tipo_id</th>
				<th>Modelo_id</th>
				<th>Color_id</th>
				<th>Rango_id</th>
				<th>Material_id</th>
				<th>Codproducto21</th>
				<th>Usuario_id</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $producto->marca_id }}}</td>
					<td>{{{ $producto->tipo_id }}}</td>
					<td>{{{ $producto->modelo_id }}}</td>
					<td>{{{ $producto->color_id }}}</td>
					<td>{{{ $producto->rango_id }}}</td>
					<td>{{{ $producto->material_id }}}</td>
					<td>{{{ $producto->codproducto31 }}}</td>
					<td>{{{ $producto->usuario_id }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('productos.destroy', $producto->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('productos.edit', 'Edit', array($producto->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
