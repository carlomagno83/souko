@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h3>Editar Mercaderia</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::model($mercaderia, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('mercaderias.update', $mercaderia->id))) }}

        <div class="form-group">
            {{ Form::label('producto_id', 'Producto:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::select('producto_id', $productos, Input::old('producto_id'), array( 'class'=>'form-control', 'disabled')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('local_id', 'Local:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::select('local_id', $locals, Input::old('local_id'), array( 'class'=>'form-control', 'disabled')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('estado', 'Estado:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::select('estado', array('ACT'=>'ACT', 'INA'=>'INA'), Input::old('estado'), array( 'class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('usuario_id', 'Usuario:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::select('usuario_id', $users, Input::old('usuario_id'), array( 'class'=>'form-control', 'disabled')) }}
            </div>
        </div>


<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Actualizar', array('class' => 'btn btn-lg btn-primary')) }}
      {{ link_to_route('mercaderias.show', 'Cancelar', $mercaderia->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop