@extends('layouts.scaffold')

@section('main')

<h3>Muestra Material</h3>

<p>{{ link_to_route('materials.index', 'Regresar a la Tabla de Materiales', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Código 3 (etqta)</th>
				<th>Descripción</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $material->codmaterial3 }}}</td>
					<td>{{{ $material->desmaterial }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('materials.destroy', $material->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('materials.edit', 'Editar', array($material->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
