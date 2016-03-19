@extends('layouts.scaffold')

@section('main')

<h3>Tabla Maestra de Materiales</h3>

<p>{{ link_to_route('materials.create', 'Agregar Nuevo Material', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($materials->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Código 3 (etqta)</th>
				<th>Descripción</th>
				<th>Usuario</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($materials as $material)
				<tr>
					<td>{{{ $material->codmaterial3 }}}</td>
					<td>{{{ $material->desmaterial }}}</td>
					<td>{{{ $material->desusuario }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('materials.destroy', $material->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('materials.edit', 'Editar', array($material->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No hay materiales para mostrar
@endif

@stop
