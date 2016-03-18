@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h3>Editar Usuario</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::model($user, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('users.update', $user->id))) }}

        <div class="form-group">
            {{ Form::label('username', 'Username (Max 6 caracteres):', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('username', Input::old('username'), array('class'=>'form-control', 'placeholder'=>'Codusuario6', 'maxlength'=>'6')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('desusuario', 'Nombre Completo:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('desusuario', Input::old('desusuario'), array('class'=>'form-control', 'placeholder'=>'Desusuario')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('rolusuario', 'Rol:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::select('rolusuario', array('SUPER'=>'SUPER', 'ADMIN'=>'ADMIN', 'ALMAC'=>'ALMAC', 'VENDE'=>'VENDE'), Input::old('rolusuario'), array( 'class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Password:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::password('password', Input::old('password'), array('class'=>'form-control', 'placeholder'=>"********")) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('usuario_id', 'Usuario Modif/Creador:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('usuario_id', Input::old('usuario_id'), array('class'=>'form-control', 'placeholder'=>'Usuario_id')) }}
            </div>
        </div>


<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Actualizar', array('class' => 'btn btn-lg btn-primary')) }}
      {{ link_to_route('users.show', 'Cancelar', $user->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop