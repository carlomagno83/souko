@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h3>Agregar Nuevo Modelo</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'modelos.store', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('codmodelo6', 'Código 6 (etqta):', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('codmodelo6', Input::old('codmodelo6'), array('class'=>'form-control', 'maxlength'=>'6')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('desmodelo', 'Descripción:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('desmodelo', Input::old('desmodelo'), array('class'=>'form-control')) }}
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
                    codmodelo6: {
                        required:true,
                        minlength: 2,
                        alphanumeric:true
                    },
                    desmodelo: {
                        required: true
                    }
                },
                messages: {

                }
            });

        });

    </script>

@stop

