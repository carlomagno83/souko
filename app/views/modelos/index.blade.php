@extends('layouts.scaffold')

@section('main')

<h3>Tabla Maestra de Modelos</h3>

<p>{{ link_to_route('modelos.create', 'Agregar Nuevo Modelo', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($modelos->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Código 6 (etqta)</th>
				<th>Descripción</th>
				<th>Usuario</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($modelos as $modelo)
				<tr>
					<td>{{{ $modelo->codmodelo6 }}}</td>
					<td>{{{ $modelo->desmodelo }}}</td>
					<td>{{{ $modelo->desusuario }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('modelos.destroy', $modelo->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('modelos.edit', 'Editar', array($modelo->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No hay modelos para mostrar
@endif

@stop
