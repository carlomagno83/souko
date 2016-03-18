@extends('layouts.scaffold')

@section('main')

<h1>All Movimientos</h1>

<p>{{ link_to_route('movimientos.create', 'Add New Movimiento', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($movimientos->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Mercaderia_id</th>
				<th>Documento_id</th>
				<th>Flagoferta</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($movimientos as $movimiento)
				<tr>
					<td>{{{ $movimiento->mercaderia_id }}}</td>
					<td>{{{ $movimiento->documento_id }}}</td>
					<td>{{{ $movimiento->flagoferta }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('movimientos.destroy', $movimiento->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('movimientos.edit', 'Edit', array($movimiento->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no movimientos
@endif

@stop
