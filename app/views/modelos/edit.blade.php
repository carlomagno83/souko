@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h3>Editar Modelo</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::model($modelo, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('modelos.update', $modelo->id))) }}

        <div class="form-group">
            {{ Form::label('codmodelo6', 'Código 6 (etqta):', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('codmodelo6', Input::old('codmodelo6'), array('class'=>'form-control', 'placeholder'=>'Codmodelo6')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('desmodelo', 'Descripción:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('desmodelo', Input::old('desmodelo'), array('class'=>'form-control', 'placeholder'=>'Desmodelo')) }}
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
      {{ Form::submit('Actualizar', array('class' => 'btn btn-lg btn-primary')) }}
      {{ link_to_route('modelos.show', 'Cancelar', $modelo->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop