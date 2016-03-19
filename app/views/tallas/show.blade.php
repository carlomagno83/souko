@extends('layouts.scaffold')

@section('main')

<h1>Show Talla</h1>

<p>{{ link_to_route('tallas.index', 'Return to All tallas', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Codtalla3</th>
				<th>Codtalla6</th>
				<th>Destalla</th>
				<th>Usuario_id</th>
				<th>Rango_id</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $talla->codtalla3 }}}</td>
					<td>{{{ $talla->codtalla6 }}}</td>
					<td>{{{ $talla->destalla }}}</td>
					<td>{{{ $talla->usuario_id }}}</td>
					<td>{{{ $talla->rango_id }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('tallas.destroy', $talla->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('tallas.edit', 'Edit', array($talla->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
