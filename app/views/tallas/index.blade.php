@extends('layouts.scaffold')

@section('main')

<h3>Maestro de Tallas</h3>

<p>{{ link_to_route('tallas.create', 'Add New Talla', null, array('class' => 'btn btn-lg btn-success')) }}

<!-- Single button -->
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    Escoger Rangos <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
   <li><a href="tallas">Mostrar todos</a></li>
<!--     <li><a href="#">Something else here</a></li>-->
		@foreach ($rangos as $rango)
			<tr>
				<td>{{{ $talla->codtalla3 }}}</td>
				<td>{{{ $talla->codtalla6 }}}</td>
				<td>{{{ $talla->destalla }}}</td>
				<td>{{{ $talla->usuario_id }}}</td>
				<td>{{{ $talla->desrango }}}</td>
                <td>
                    {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('tallas.destroy', $talla->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                    {{ Form::close() }}
                    {{ link_to_route('tallas.edit', 'Edit', array($talla->id), array('class' => 'btn btn-info')) }}
                </td>
			</tr>
		@endforeach





  </ul>
</div>
</p>


@if ($tallas->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Codtalla3</th>
				<th>Codtalla6</th>
				<th>Destalla</th>
				<th>Usuario_id</th>
				<th>Descripcion de rango</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($tallas as $talla)
				<tr>
					<td>{{{ $talla->codtalla3 }}}</td>
					<td>{{{ $talla->codtalla6 }}}</td>
					<td>{{{ $talla->destalla }}}</td>
					<td>{{{ $talla->usuario_id }}}</td>
					<td>{{{ $talla->desrango }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('tallas.destroy', $talla->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('tallas.edit', 'Edit', array($talla->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no tallas
@endif

@stop
