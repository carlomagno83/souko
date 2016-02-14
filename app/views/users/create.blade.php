@extends('layouts.scaffold')

@section('main')

{{--<div align="right">--}}
    {{--<a id="home" href=" {{ URL::to('/') }} "><img src='../img/home.ico' border='0'></a>--}}
{{--</div>--}}
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
            <div class="col-sm-5">
              {{ Form::text('username', Input::old('codusuario6'), array('class'=>'form-control', 'maxlength'=>'6')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('desusuario', 'Nombre Completo:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('desusuario', Input::old('desusuario'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('rolusuario', 'Rol:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::select('rolusuario', array(''=>'','SUPER'=>'SUPER', 'ADMIN'=>'ADMIN', 'ALMAC'=>'ALMAC', 'VENDE'=>'VENDE'), Input::old('rolusuario'), array( 'class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Password:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('password', Input::old('password'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('usuario_id', 'Usuario_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('usuario_id', Input::old('usuario_id'), array('class'=>'form-control')) }}
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


