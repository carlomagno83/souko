@extends('layouts.scaffold')

@section('main')

<h3>Muestra Marca</h3>

<p>{{ link_to_route('marcas.index', 'Regresar a la Tabla de Marcas', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Código 3 (etqta)</th>
				<th>Descripción</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $marca->codmarca3 }}}</td>
			<td>{{{ $marca->desmarca }}}</td>
            <td>
                {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('marcas.destroy', $marca->id))) }}
                    {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
                {{ link_to_route('marcas.edit', 'Editar', array($marca->id), array('class' => 'btn btn-info')) }}
            </td>
		</tr>
	</tbody>
</table>

@stop
