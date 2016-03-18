@extends('layouts.scaffold')

@section('main')

<h1>All Tipomovimientos</h1>

<p>{{ link_to_route('tipomovimientos.create', 'Add New Tipomovimiento', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($tipomovimientos->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Codtipomovimiento3</th>
				<th>Codtipomovimiento6</th>
				<th>Destipomovimiento</th>
				<th>Usuario_id</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($tipomovimientos as $tipomovimiento)
				<tr>
					<td>{{{ $tipomovimiento->codtipomovimiento3 }}}</td>
					<td>{{{ $tipomovimiento->codtipomovimiento6 }}}</td>
					<td>{{{ $tipomovimiento->destipomovimiento }}}</td>
					<td>{{{ $tipomovimiento->usuario_id }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('tipomovimientos.destroy', $tipomovimiento->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('tipomovimientos.edit', 'Edit', array($tipomovimiento->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no tipomovimientos
@endif

@stop
