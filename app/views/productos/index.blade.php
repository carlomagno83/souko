@extends('layouts.scaffold')

@section('main')

<h3>Tabla maestra de Productos</h3>
{{ Form::open(['route' => 'productos.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left pull-rigth', 'role' => 'search']) }}
<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <div class="form-group">
            {{ Form::label('provider_id', 'Proveedor:', array('class'=>'col-md-1 control-label')) }}
            <div class="col-sm-3">
              {{ Form::select('provider_id',[""=>'Escoja una opción'] + $providers, Input::old('provider_id'), array('class'=>'form-control')) }}
            </div>            

            {{ Form::label('marca_id', 'Marca:', array('class'=>'col-md-1 control-label')) }}
            <div class="col-sm-3">
              {{ Form::select('marca_id',[""=>'Escoja una opción'] + $marcas, Input::old('marca_id'), array('class'=>'form-control')) }}
            </div>

            {{ Form::label('tipo_id', 'Tipo:', array('class'=>'col-md-1 control-label')) }}
            <div class="col-sm-3">
              {{ Form::select('tipo_id',[""=>'Escoja una opción'] + $tipos, Input::old('tipo_id'), array('class'=>'form-control')) }}
            </div>

            {{ Form::label('modelo_id', 'Modelo:', array('class'=>'col-md-1 control-label')) }}
            <div class="col-sm-3">
              {{ Form::select('modelo_id',[""=>'Escoja una opción'] + $modelos, Input::old('modelo_id'), array('class'=>'form-control')) }}
            </div>

             {{ Form::label('material_id', 'Material:', array('class'=>'col-md-1 control-label')) }}
            <div class="col-sm-3">
              {{ Form::select('material_id',[""=>'Escoja una opción'] + $materials, Input::old('material_id'), array('class'=>'form-control')) }}
            </div>

            {{ Form::label('color_id', 'Color:', array('class'=>'col-md-1 control-label')) }}
            <div class="col-sm-3">
              {{ Form::select('color_id',[""=>'Escoja una opción'] + $colors, Input::old('color_id'), array('class'=>'form-control')) }}
            </div>

            {{ Form::label('rango_id', 'Rango:', array('class'=>'col-md-1 control-label')) }}
            <div class="col-sm-3">
              {{ Form::select('rango_id',[""=>'Escoja una opción'] + $rangos, Input::old('rango_id'), array('class'=>'form-control')) }}
            </div>

            <button type="submit" class="btn btn-info">Filtrar</button>
                       
        </div>
    </div>
</div>  

{{ Form::close() }}
<br>
<p>{{ link_to_route('productos.create', 'Crear Rango de Productos', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($productos->count())
	<table class="table table-striped">
		<thead>
			<tr> 
                <th>Proveedor</th>
				<th>Marca</th>
				<th>Tipo</th>
				<th>Modelo</th>
				<th>Material</th>
				<th>Color</th>
				<th>Rango</th>
				<th>Talla</th>
				<th>Etiqueta</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($productos as $producto)
				<tr>
                    <td>{{{ $producto->codprovider3 }}}</td>
					<td>{{{ $producto->codmarca3 }}}</td>
					<td>{{{ $producto->codtipo8 }}}</td>
					<td>{{{ $producto->codmodelo6 }}}</td>
					<td>{{{ $producto->codmaterial3 }}}</td>
					<td>{{{ $producto->codcolor6 }}}</td>
					<td>{{{ $producto->codrango3 }}}</td>
					<td>{{{ $producto->talla_id }}}</td>
					<td>{{{ $producto->codproducto31 }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('productos.destroy', $producto->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No hay productos para mostrar
@endif

@stop
