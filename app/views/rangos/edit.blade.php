@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h3>Editar Rango</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::model($rango, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('rangos.update', $rango->id))) }}


        <div class="form-group">
            {{ Form::label('codrango6', 'Código 6 (xx/yy)(etqta):', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('codrango6', Input::old('codrango6'), array('class'=>'form-control', 'placeholder'=>'Codrango6', 'maxlength'=>'5')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('desrango', 'Descripción:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('desrango', Input::old('desrango'), array('class'=>'form-control', 'placeholder'=>'Desrango')) }}
            </div>
        </div>

<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Actualizar', array('class' => 'btn btn-lg btn-primary')) }}
      {{ link_to_route('rangos.show', 'Cancelar', $rango->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop