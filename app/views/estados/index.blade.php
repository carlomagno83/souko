@extends('layouts.scaffold')


@section("main")

<h1>All Estados</h1>

<p>{{ link_to_route('estados.create', 'Add New Estado', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($estados->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Codestado3</th>
				<th>Codestado6</th>
				<th>Desestado</th>
				<th>Usuario_id</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($estados as $estado)
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
			@endforeach
		</tbody>
	</table>
@else
	There are no estados
@endif

@stop
