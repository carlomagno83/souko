@extends('layouts.scaffold')

@section('main')

<h3>Tabla Maestra de Proveedores</h3>

<p>{{ link_to_route('providers.create', 'Agregar Nuevo Proveedor', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($providers->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Código 3</th>
				<th>Descripción</th>
				<th>Usuario</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($providers as $provider)
				<tr>
					<td>{{{ $provider->codprovider3 }}}</td>
					<td>{{{ $provider->desprovider }}}</td>
					<td>{{{ $provider->desusuario }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('providers.destroy', $provider->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('providers.edit', 'Editar', array($provider->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No hay Proveedores que mostrar
@endif

@stop
