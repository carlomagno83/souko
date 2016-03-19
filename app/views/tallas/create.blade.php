@extends('layouts.scaffold')

@section('main')

{{--<div align="right">--}}
    {{--<a id="home" href=" {{ URL::to('/') }} "><img src='../img/home.ico' border='0'></a>--}}
{{--</div>--}}
<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h3>Crear Talla</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'tallas.store', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('codtalla3', 'Codtalla3:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('codtalla3', Input::old('codtalla3'), array('class'=>'form-control', 'placeholder'=>'Codtalla3')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('codtalla6', 'Codtalla6:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('codtalla6', Input::old('codtalla6'), array('class'=>'form-control', 'placeholder'=>'Codtalla6')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('destalla', 'Destalla:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('destalla', Input::old('destalla'), array('class'=>'form-control', 'placeholder'=>'Destalla')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('usuario_id', 'Usuario_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'usuario_id', Input::old('usuario_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('rango_id', 'Rango_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'rango_id', Input::old('rango_id'), array('class'=>'form-control')) }}
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


