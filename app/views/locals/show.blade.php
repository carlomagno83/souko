@extends('layouts.scaffold')

@section('main')

<h3>Muestra Local</h3>

<p>{{ link_to_route('locals.index', 'Regresar a la Tabla de Locales', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Código 3 (etqta)</th>
				<th>Código 6</th>
				<th>Descripción</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $local->codlocal3 }}}</td>
					<td>{{{ $local->codlocal6 }}}</td>
					<td>{{{ $local->deslocal }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('locals.destroy', $local->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('locals.edit', 'Editar', array($local->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
