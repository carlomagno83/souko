@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h3>Agregar Nuevo Rango</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'rangos.store', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('codrango3', 'Código 3 (etqta):', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('codrango3', Input::old('codrango3'), array('class'=>'form-control', 'placeholder'=>'Codrango3')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('codrango6', 'Código 6 (para generar productos, xx-yy):', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('codrango6', Input::old('codrango6'), array('class'=>'form-control', 'placeholder'=>'Codrango6')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('desrango', 'Descripción:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('desrango', Input::old('desrango'), array('class'=>'form-control', 'placeholder'=>'Desrango')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('usuario_id', 'Usuario:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'usuario_id', Input::old('usuario_id'), array('class'=>'form-control')) }}
            </div>
        </div>


<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Crear', array('class' => 'btn btn-lg btn-primary')) }}
    </div>
</div>

{{ Form::close() }}

@stop


