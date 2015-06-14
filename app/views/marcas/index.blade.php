@extends('layouts.scaffold')

@section('main')

<h3>Tabla maestra de Marcas</h3>

<p>{{ link_to_route('marcas.create', 'Agregar Nueva Marca', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($marcas->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Cod 3 (etqta)</th>
				<th>Descripción</th>
				<th>Usuario</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($marcas as $marca)
				<tr>
					<td>{{{ $marca->codmarca3 }}}</td>
					<td>{{{ $marca->desmarca }}}</td>
					<td>{{{ $marca->desusuario }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('marcas.destroy', $marca->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('marcas.edit', 'Editar', array($marca->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No hay Marcas para mostrar
@endif

@stop
