@extends('layouts.scaffold')

@section('main')

<h3>Muestra Proveedor</h3>

<p>{{ link_to_route('providers.index', 'Regresar a la Tabla de Proveedores', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Código 3</th>
				<th>Código 6</th>
				<th>Descripción</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $provider->codprovider3 }}}</td>
					<td>{{{ $provider->codprovider6 }}}</td>
					<td>{{{ $provider->desprovider }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('providers.destroy', $provider->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('providers.edit', 'Editar', array($provider->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
