@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h3>Crear Usuario</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'users.store', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('username', 'Username (Max 6 Caracteres):', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('username', Input::old('codusuario6'), array('class'=>'form-control', 'placeholder'=>'Codusuario6')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('desusuario', 'Nombre Completo:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('desusuario', Input::old('desusuario'), array('class'=>'form-control', 'placeholder'=>'Desusuario')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('rolusuario', 'Rol:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('rolusuario', Input::old('rolusuario'), array('class'=>'form-control', 'placeholder'=>'Rolusuario')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Password:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('password', Input::old('password'), array('class'=>'form-control', 'placeholder'=>'Password')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('usuario_id', 'Usuario_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('usuario_id', Input::old('usuario_id'), array('class'=>'form-control', 'placeholder'=>'Usuario_id')) }}
            </div>
        </div>


<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Create', array('class' => 'btn btn-lg btn-primary')) }}
    </div>
</div>

{{ Form::close() }}

@stop


