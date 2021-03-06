@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h3>Nuevo Tipo</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'tipos.store', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('codtipo8', 'Coódigo 8 (etqta):', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('codtipo8', Input::old('codtipo8'), array('class'=>'form-control', 'maxlength'=>'8')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('destipo', 'Descripción:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('destipo', Input::old('destipo'), array('class'=>'form-control')) }}
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


@section('scripts')

    <script>

        $().ready(function() {

            $("form").validate({
                rules: {
                    codtipo8: {
                        required:true,
                        minlength: 2,
                        alphanumeric:true
                    },
                    destipo: {
                        required: true
                    }
                },
                messages: {

                }
            });

        });

    </script>

@stop
