@extends('layouts.scaffold')

@section('main')

<h3>Tabla Maestra de Locales</h3>

<p>{{ link_to_route('locals.create', 'Agregar Nuevo Local', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($locals->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Código 3 (etqta)</th>
				<th>Código 6</th>
				<th>Descripción</th>
				<th>Usuario</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($locals as $local)
				<tr>
					<td>{{{ $local->codlocal3 }}}</td>
					<td>{{{ $local->codlocal6 }}}</td>
					<td>{{{ $local->deslocal }}}</td>
					<td>{{{ $local->desusuario }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('locals.destroy', $local->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('locals.edit', 'Editar', array($local->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No hay locales para mostrar
@endif

@stop
