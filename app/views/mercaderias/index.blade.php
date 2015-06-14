@extends('layouts.scaffold')

@section('main')

<h3>Tabla Maestra de Mercaderias</h3>
<!--
<p>{{ link_to_route('mercaderias.create', 'Agregar Nueva Mercaderia', null, array('class' => 'btn btn-lg btn-success')) }}</p>
-->

@if ($mercaderias->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Id</th>
				<th>Producto cod 31</th>
				<th>Local id</th>
				<th>Estado</th>
				<th>Usuario</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($mercaderias as $mercaderia)
				<tr>
					<td>{{{ $mercaderia->id }}}</td>
					<td>{{{ $mercaderia->codproducto31 }}}</td>
					<td>{{{ $mercaderia->deslocal }}}</td>
					<td>{{{ $mercaderia->estado }}}</td>
					<td>{{{ $mercaderia->desusuario }}}</td>
                    <td>
                        {{ link_to_route('mercaderias.edit', 'Editar', array($mercaderia->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No hay mercaderias para mostrar
@endif

@stop
