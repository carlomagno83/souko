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
				<th>Proveed</th>
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
					<td>{{{ $mercaderia->codprovider3 }}}</td>
					<td>{{{ $mercaderia->id }}}</td>
					<td>{{{ $mercaderia->codproducto31 }}}</td>
					<td>{{{ $mercaderia->deslocal }}}</td>
					@if ($mercaderia->estado=='ACT')
					    <td><input type="text" value="{{ $mercaderia->estado }}" readonly class="form-control"></td>
					@else
					    <td class="danger"><input value="{{ $mercaderia->estado }}" readonly class="form-control"></td>
					@endif  
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
