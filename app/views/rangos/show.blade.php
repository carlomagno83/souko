@extends('layouts.scaffold')

@section('main')

<h3>Muestra Rango</h3>

<p>{{ link_to_route('rangos.index', 'Regresar a la Tabla de Rangos', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

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
			<td>{{{ $rango->codrango3 }}}</td>
					<td>{{{ $rango->codrango6 }}}</td>
					<td>{{{ $rango->desrango }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('rangos.destroy', $rango->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('rangos.edit', 'Editar', array($rango->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
