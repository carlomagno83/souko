@extends('layouts.scaffold')

@section('main')

<h3>Mostrar Mercaderia</h3>

<p>{{ link_to_route('mercaderias.index', 'Regresar a la Tabla de mercaderias', null, array('class'=>'btn btn-lg btn-primary')) }}</p>
<?php $productos = DB::table('productos')->select('codproducto31')->where('id', '=', $mercaderia["producto_id"])->pluck('codproducto31') ?>
<?php $locals = DB::table('locals')->select('deslocal')->where('id', '=', $mercaderia["local_id"])->pluck('deslocal') ?>
<?php $users = DB::table('users')->select('desusuario')->where('id', '=', $mercaderia["usuario_id"])->pluck('desusuario') ?>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Id</th>
			<th>Producto</th>
			<th>Local</th>
			<th>Estado</th>
			<th>Usuario</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $mercaderia->id }}}</td>
			<td>{{{ $productos }}}</td>
			<td>{{{ $locals }}}</td>
			@if ($mercaderia->estado=='ACT')
			    <td><input type="text" value="{{ $mercaderia->estado }}" readonly class="form-control"></td>
			@else
			    <td class="danger"><input value="{{ $mercaderia->estado }}" readonly class="form-control"></td>
			@endif              
			<td>{{{ $users }}}</td>
            <td>
                {{ link_to_route('mercaderias.edit', 'Editar', array($mercaderia->id), array('class' => 'btn btn-info')) }}
            </td>
		</tr>
	</tbody>
</table>

@stop
