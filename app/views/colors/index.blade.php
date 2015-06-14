@extends('layouts.scaffold')

@section("styles")
<style>

body{
background-color:#fff;
}
</style>
@stop

@section("main")

<h3>Tabla maestra Colores</h3>

<p>{{ link_to_route('colors.create', 'Agregar nuevo Color', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($colors->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Código 6 (etqta)</th>
				<th>Descripción</th>
				<th>Usuario</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($colors as $color)
				<tr>
					<td>{{{ $color->codcolor6 }}}</td>
					<td>{{{ $color->descolor }}}</td>
					<td>{{{ $color->desusuario }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('colors.destroy', $color->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('colors.edit', 'Editar', array($color->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no colors
@endif

@stop


@section("scripts")

<script>

//alert('hola')
</script>

@stop