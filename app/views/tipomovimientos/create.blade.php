@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Create Tipomovimiento</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'tipomovimientos.store', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('codtipomovimiento3', 'Codtipomovimiento3:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('codtipomovimiento3', Input::old('codtipomovimiento3'), array('class'=>'form-control', 'placeholder'=>'Codtipomovimiento3')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('codtipomovimiento6', 'Codtipomovimiento6:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('codtipomovimiento6', Input::old('codtipomovimiento6'), array('class'=>'form-control', 'placeholder'=>'Codtipomovimiento6')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('destipomovimiento', 'Destipomovimiento:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('destipomovimiento', Input::old('destipomovimiento'), array('class'=>'form-control', 'placeholder'=>'Destipomovimiento')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('usuario_id', 'Usuario_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
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


