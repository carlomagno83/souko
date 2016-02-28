@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h3>Agregar Nuevo Rango</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'rangos.store', 'class' => 'form-horizontal')) }}



        <div class="form-group">
            {{ Form::label('codrango6', 'Código 6 (para generar productos, xx/yy):', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('codrango6', Input::old('codrango6'), array('class'=>'form-control', 'maxlength'=>'5')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('desrango', 'Descripción:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('desrango', Input::old('desrango'), array('class'=>'form-control')) }}
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
                    codrango3: {
                        required:true,
                        minlength: 2
                    },
                    codrango6: {
                        required: true
                    },
                    desrango: {
                        required: true
                    }
                },
                messages: {

                }
            });

        });

    </script>

@stop
