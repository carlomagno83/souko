@extends('layouts.scaffold')

@section('main')

<h3>Activación de Usuarios</h3>

<br>

@if ($users->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th width="10%">Id</th>
				<th width="10%">Username</th>
				<th width="25%">Nombre Completo</th>
				<th width="10%">Rol</th>
				<th width="10%">Estado</th>
				<th></th>

			</tr>
		</thead>

		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{{ $user->id }}}</td>
					<td>{{{ $user->username }}}</td>
					<td>{{{ $user->desusuario }}}</td>
					<td>{{{ $user->rolusuario }}}</td>
					@if ($user->estado=='ACT')
						<td>{{{ $user->estado }}}</td>
					@else
						<td class="danger">{{{ $user->estado }}}</td>
					@endif

					<td><a id="link_detalle" href=" {{ URL::to('cambiarestado/'.$user->id) }} "><font color="0000FF">Cambiar Estado ACT/INA</font></a>  </td>
					
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No hay Usuarios para mostrar
@endif

@stop
