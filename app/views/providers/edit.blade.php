@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h3>Editar Proveedor</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::model($provider, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('providers.update', $provider->id))) }}

        <div class="form-group">
            {{ Form::label('codprovider3', 'Código 3:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('codprovider3', Input::old('codprovider3'), array('class'=>'form-control', 'placeholder'=>'Codprovider3')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('codprovider6', 'Código 6:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('codprovider6', Input::old('codprovider6'), array('class'=>'form-control', 'placeholder'=>'Codprovider6')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('desprovider', 'Descripción:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('desprovider', Input::old('desprovider'), array('class'=>'form-control', 'placeholder'=>'Desprovider')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('usuario_id', 'Usuario:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('usuario_id', Input::old('usuario_id'), array('class'=>'form-control', 'placeholder'=>'Usuario_id')) }}
            </div>
        </div>


<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Actualizar', array('class' => 'btn btn-lg btn-primary')) }}
      {{ link_to_route('providers.show', 'Cancelar', $provider->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop