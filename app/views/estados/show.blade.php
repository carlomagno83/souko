@extends('layouts.scaffold')

@section('main')

<h1>Show Estado</h1>

<p>{{ link_to_route('estados.index', 'Return to All estados', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Codestado3</th>
				<th>Codestado6</th>
				<th>Desestado</th>
				<th>Usuario_id</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $estado->codestado3 }}}</td>
					<td>{{{ $estado->codestado6 }}}</td>
					<td>{{{ $estado->desestado }}}</td>
					<td>{{{ $estado->usuario_id }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('estados.destroy', $estado->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('estados.edit', 'Edit', array($estado->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
