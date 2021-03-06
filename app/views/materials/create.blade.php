@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h3>Agregar Nuevo Material</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'materials.store', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('codmaterial3', 'Código 3 (etqta):', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('codmaterial3', Input::old('codmaterial3'), array('class'=>'form-control', 'maxlength'=>'3')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('desmaterial', 'Descripción:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('desmaterial', Input::old('desmaterial'), array('class'=>'form-control')) }}
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
                    codmaterial3: {
                        required:true,
                        minlength: 2,
                        alphanumeric:true
                    },
                    desmaterial: {
                        required: true
                    }
                },
                messages: {

                }
            });

        });

    </script>

@stop
