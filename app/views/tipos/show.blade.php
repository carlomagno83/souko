@extends('layouts.scaffold')

@section('main')

<h3>Muestra Tipo</h3>

<p>{{ link_to_route('tipos.index', 'Regresar a la Tabla de Tipos', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
				<th>Código 8 (etqta)</th>
				<th>Descripción</th>
		</tr>
	</thead>

	<tbody>
		<tr>
					<td>{{{ $tipo->codtipo8 }}}</td>
					<td>{{{ $tipo->destipo }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('tipos.destroy', $tipo->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('tipos.edit', 'Editar', array($tipo->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
