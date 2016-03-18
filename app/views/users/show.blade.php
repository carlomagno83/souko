@extends('layouts.scaffold')

@section('main')

<h3>Tabla Maestra de Usuarios</h3>

<p>{{ link_to_route('users.index', 'Regresar a la Tabla de Usuarios', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
				<th>Username</th>
				<th>Nombre Completo</th>
				<th>Rol</th>
				<th>Password</th>
				<th>Modif/creado por</th>
		</tr>
	</thead>

	<tbody>
		<tr>

					<td>{{{ $user->username }}}</td>
					<td>{{{ $user->desusuario }}}</td>
					<td>{{{ $user->rolusuario }}}</td>
					<td>{{ "******" }}</td>
					<td>{{{ $user->usuario_id }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('users.destroy', $user->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('users.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
