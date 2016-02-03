@extends('layouts.scaffold')

@section('main')

<div align="right">
    <a id="home" href=" {{ URL::to('/') }} "><img src='../img/home.ico' border='0'></a>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h3>Crear Nuevo Local</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'locals.store', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('codlocal3', 'Código 3 (etqta):', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('codlocal3', Input::old('codlocal3'), array('class'=>'form-control', 'maxlength'=>'3')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('codlocal6', 'Código 6:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('codlocal6', Input::old('codlocal6'), array('class'=>'form-control', 'maxlength'=>'6')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('deslocal', 'Descripción:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('deslocal', Input::old('deslocal'), array('class'=>'form-control')) }}
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


