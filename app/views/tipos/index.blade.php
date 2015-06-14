@extends('layouts.scaffold')

@section('main')

<h3>Tabla maestra de Tipos</h3>

<p>{{ link_to_route('tipos.create', 'Agregar Nuevo Tipo', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($tipos->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Código 8 (etqta)</th>
				<th>Descripción</th>
				<th>Usuario</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($tipos as $tipo)
				<tr>
					<td>{{{ $tipo->codtipo8 }}}</td>
					<td>{{{ $tipo->destipo }}}</td>
					<td>{{{ $tipo->desusuario }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('tipos.destroy', $tipo->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('tipos.edit', 'Editar', array($tipo->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No hay tipos para mostrar
@endif

@stop
