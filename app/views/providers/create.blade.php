@extends('layouts.scaffold')

@section('main')

<div align="right">
    <a id="home" href=" {{ URL::to('/') }} "><img src='../img/home.ico' border='0'></a>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h3>Agregar Nuevo Proveedor</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'providers.store', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('codprovider3', 'Código 3:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('codprovider3', Input::old('codprovider3'), array('class'=>'form-control', 'maxlength'=>'3')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('codprovider6', 'Código 6:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('codprovider6', Input::old('codprovider6'), array('class'=>'form-control', 'maxlength'=>'6')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('desprovider', 'Descripción:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('desprovider', Input::old('desprovider'), array('class'=>'form-control')) }}
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


