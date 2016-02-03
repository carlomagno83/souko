@extends('layouts.scaffold')

@section('main')

<h3>Muestra Modelo</h3>

<p>{{ link_to_route('modelos.index', 'Regresar a la Tabla de Modelos', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
				<th>Código 6 (etqta)</th>
				<th>Descripción</th>
		</tr>
	</thead>

	<tbody>
		<tr>
					<td>{{{ $modelo->codmodelo6 }}}</td>
					<td>{{{ $modelo->desmodelo }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('modelos.destroy', $modelo->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('modelos.edit', 'Editar', array($modelo->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
