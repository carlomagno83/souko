@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Edit Producto</h1>

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
            {{ Form::label('marca_id', 'Marca_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'marca_id', Input::old('marca_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('tipo_id', 'Tipo_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'tipo_id', Input::old('tipo_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('modelo_id', 'Modelo_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'modelo_id', Input::old('modelo_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('color_id', 'Color_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'color_id', Input::old('color_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('rango_id', 'Rango_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('rango_id', Input::old('rango_id'), array('class'=>'form-control', 'placeholder'=>'Rango_id')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('material_id', 'Material_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'material_id', Input::old('material_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('desproducto', 'Desproducto:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('desproducto', Input::old('desproducto'), array('class'=>'form-control', 'placeholder'=>'Desproducto')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('codproducto21', 'Codproducto21:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('codproducto21', Input::old('codproducto21'), array('class'=>'form-control', 'placeholder'=>'Codproducto21')) }}
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
      {{ Form::submit('Update', array('class' => 'btn btn-lg btn-primary')) }}
      {{ link_to_route('productos.show', 'Cancel', $producto->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop