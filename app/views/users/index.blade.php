@extends('layouts.scaffold')

@section('main')

<h3>Tabla Maestra de Usuarios</h3>

<p>{{ link_to_route('users.create', 'Agregar Nuevo Usuario', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($users->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Username</th>
				<th>Nombre Completo</th>
				<th>Rol</th>
				<th>Password</th>
				<th>Usuario Creador/Modif</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{{ $user->username }}}</td>
					<td>{{{ $user->desusuario }}}</td>
					<td>{{{ $user->rolusuario }}}</td>
					<td>{{ "******" }}</td>
					<td>{{{ $user->usuario_id }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('users.destroy', $user->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('users.edit', 'Editar', array($user->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No hay Usuarios para mostrar
@endif

@stop
