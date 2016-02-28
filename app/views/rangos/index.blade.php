@extends('layouts.scaffold')

@section('main')

<h3>Tabla Maestra de Rangos</h3>

<p>{{ link_to_route('rangos.create', 'Agregar Nuevo Rango', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($rangos->count())
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
			@foreach ($rangos as $rango)
				<tr>
					<td>{{{ $rango->codrango6 }}}</td>
					<td>{{{ $rango->desrango }}}</td>
					<td>{{{ $rango->desusuario }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('rangos.destroy', $rango->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('rangos.edit', 'Editar', array($rango->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No hay rangos para mostrar
@endif

@stop
