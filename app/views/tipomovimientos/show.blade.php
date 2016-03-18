@extends('layouts.scaffold')

@section('main')

<h1>Show Tipomovimiento</h1>

<p>{{ link_to_route('tipomovimientos.index', 'Return to All tipomovimientos', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Codtipomovimiento3</th>
				<th>Codtipomovimiento6</th>
				<th>Destipomovimiento</th>
				<th>Usuario_id</th>
		</tr>
	</thead>

	<tbody>
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
	</tbody>
</table>

@stop
