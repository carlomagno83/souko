@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Create Estado</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'estados.store', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('codestado3', 'Codestado3:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('codestado3', Input::old('codestado3'), array('class'=>'form-control', 'placeholder'=>'Codestado3')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('codestado6', 'Codestado6:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('codestado6', Input::old('codestado6'), array('class'=>'form-control', 'placeholder'=>'Codestado6')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('desestado', 'Desestado:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('desestado', Input::old('desestado'), array('class'=>'form-control', 'placeholder'=>'Desestado')) }}
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


