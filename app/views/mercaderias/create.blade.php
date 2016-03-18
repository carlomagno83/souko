@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Create Mercaderia</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'mercaderias.store', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('producto_id', 'Producto_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::input('number', 'producto_id', Input::old('producto_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('mercaderiacambio_id', 'Mercaderiacambio_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::input('number', 'mercaderiacambio_id', Input::old('mercaderiacambio_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('local_id', 'Local_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::input('number', 'local_id', Input::old('local_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('estado', 'Estado:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::input('number', 'estado', Input::old('estado'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('usuario_id', 'Usuario_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::input('number', 'usuario_id', Input::old('usuario_id'), array('class'=>'form-control')) }}
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


