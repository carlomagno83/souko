@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h3>Editar Producto</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::model($producto, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('productos.update', $producto->id))) }}

        <div class="form-group">
            {{ Form::label('provider_id', 'Proveedor:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::input('number', 'provider_id', Input::old('provider_id'), array('class'=>'form-control', 'readonly')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('marca_id', 'marca_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('marca_id', Input::old('marca_id'), array('class'=>'form-control', 'placeholder'=>'marca_id', 'readonly')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('tipo_id', 'tipo_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::input('number', 'tipo_id', Input::old('tipo_id'), array('class'=>'form-control', 'placeholder'=>'tipo_id','readonly')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('modelo_id', 'modelo_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('modelo_id', Input::old('modelo_id'), array('class'=>'form-control', 'placeholder'=>'modelo_id', 'readonly')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('color_id', 'color_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('color_id', Input::old('color_id'), array('class'=>'form-control', 'placeholder'=>'color_id', 'readonly')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('rango_id', 'tipo_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::input('number', 'rango_id', Input::old('rango_id'), array('class'=>'form-control', 'placeholder'=>'rango_id','readonly')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('material_id', 'material_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('material_id', Input::old('material_id'), array('class'=>'form-control', 'placeholder'=>'material_id', 'readonly')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('codproducto31', 'Codproducto31:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('codproducto31', Input::old('codproducto31'), array('class'=>'form-control', 'placeholder'=>'codproducto31', 'readonly')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('precioventa', 'Precio de Venta:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-5">
              {{ Form::text('precioventa', Input::old('precioventa'), array('class'=>'form-control', 'placeholder'=>'precioventa')) }}
            </div>
        </div>

<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Actualizar', array('class' => 'btn btn-lg btn-primary')) }}
      {{ link_to_route('productos.show', 'Cancelar', $producto->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop