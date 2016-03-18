@extends('layouts.scaffold')

@section('main')

<h1>All Documentos</h1>

<p>{{ link_to_route('documentos.create', 'Add New Documento', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($documentos->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Fechadocumento</th>
				<th>Tipomovimiento_id</th>
				<th>Localini_id</th>
				<th>Localfin_id</th>
				<th>Flagestado</th>
				<th>Usuario_id</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($documentos as $documento)
				<tr>
					<td>{{{ $documento->fechadocumento }}}</td>
					<td>{{{ $documento->tipomovimiento_id }}}</td>
					<td>{{{ $documento->localini_id }}}</td>
					<td>{{{ $documento->localfin_id }}}</td>
					<td>{{{ $documento->flagestado }}}</td>
					<td>{{{ $documento->usuario_id }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('documentos.destroy', $documento->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('documentos.edit', 'Edit', array($documento->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no documentos
@endif

@stop
