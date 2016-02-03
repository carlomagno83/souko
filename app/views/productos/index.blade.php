@extends('layouts.scaffold')

@section('main')

<h3>Tabla maestra de Productos</h3>
<form method="POST" action="{{url('productos-filtrar')}}">
<div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="provider_id">Proveedor</span>
                {{Form::select('provider_id', [0=>''] + DB::table('providers')->orderby('desprovider')->lists('desprovider','id'), Input::get('provider_id'),array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="marca_id">Marca</span>
                {{Form::select('marca_id',[0=>''] + DB::table('marcas')->orderby('desmarca')->lists('desmarca','id'), Input::get('marca_id'),array('class'=>'form-control'))}}
           </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="tipo_id">Tipo</span>
                {{Form::select('tipo_id', [0=>''] + DB::table('tipos')->orderby('destipo')->lists('destipo','id'), Input::get('tipo_id'),array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="modelo_id">Modelo</span>
                {{Form::select('modelo_id',[0=>''] + DB::table('modelos')->orderby('desmodelo')->lists('desmodelo','id'), Input::get('modelo_id'),array('class'=>'form-control'))}}
           </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="material_id">Material</span>
                {{Form::select('material_id', [0=>''] + DB::table('materials')->orderby('desmaterial')->lists('desmaterial','id'), Input::get('material_id'),array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->

        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="color_id">Color</span>
                {{Form::select('color_id',[0=>''] + DB::table('colors')->orderby('descolor')->lists('descolor','id'), Input::get('color_id'),array('class'=>'form-control'))}}
           </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="rango_id">Rango</span>
                {{Form::select('rango_id',[0=>''] + DB::table('rangos')->orderby('desrango')->lists('desrango','id'), Input::get('rango_id'),array('class'=>'form-control'))}}
           </div>
        </div><!-- /.col-lg-6 -->
        <br>
</div>  
<br>
<div class="row">
    <div class="col-lg-10">
    </div>
    <div class="col-lg-2">
                <button type="submit" class="btn btn-info">Filtrar</button>
    </div><!-- /.col-lg-6 -->     
</div> 
</form>

<br>
<p>{{ link_to_route('productos.create', 'Crear Rango de Productos', null, array('class' => 'btn btn-lg btn-success')) }}</p>
@if (count($productos)>0)
@if ($productos->count())
	<table class="table table-striped">
		<thead>
			<tr> 
                <th>Proveedor</th>
                <th>Etiqueta</th>
                <th>P. Compra</th>
                <th>P. Venta</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
        
			@foreach ($productos as $producto)
				<tr>
                    <td>{{{ $producto->codprovider3 }}}</td>
                    <td>{{{ $producto->codproducto31 }}}</td>
                    <td>{{{ $producto->preciocompra }}}</td>
                    <td>{{{ $producto->precioventa }}}</td>

                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('productos.destroy', $producto->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('productos.edit', 'Editar', array($producto->id), array('class' => 'btn btn-info')) }}

                    </td>
				</tr>
			@endforeach
           
		</tbody>
	</table>
@else
	No hay productos para mostrar
@endif
@endif 
@stop
