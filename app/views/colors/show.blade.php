@extends('layouts.scaffold')

@section('main')

<h3>Muestra Color</h3>

<p>{{ link_to_route('colors.index', 'Regresar a la Tabla de Colores', null, array('class'=>'btn btn-lg btn-primary')) }}</p>
<?php $users = DB::table('users')->select('desusuario')->where('id', '=', $color["usuario_id"])->pluck('desusuario') ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Código 6 (etqta)</th>
			<th>Descripción</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>{{{ $color->codcolor6 }}}</td>
			<td>{{{ $color->descolor }}}</td>
            <td>
                {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('colors.destroy', $color->id))) }}
                    {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
                {{ link_to_route('colors.edit', 'Editar', array($color->id), array('class' => 'btn btn-info')) }}
            </td>
		</tr>
	</tbody>
</table>


@stop
