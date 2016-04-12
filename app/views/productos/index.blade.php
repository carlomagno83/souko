@extends('layouts.scaffold')

@section('main')


<h3>Tabla maestra de Productos</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </ul>
    </div>
@endif

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
                <span class="input-group-addon" id="rango_id">Rango</span>
                {{Form::select('rango_id',[0=>''] + DB::table('rangos')->orderby('desrango')->lists('desrango','id'), Input::get('rango_id'),array('class'=>'form-control'))}}
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


<form method="POST" id="formulario" action="{{url('editabloque')}}">
@if (count($productos)>0)

<div>Mostrando {{count($productos)}} producto(s)</div>

	<table class="table table-striped">
		<thead>
			<tr> 
                <th width="5%">Proveedor</th>
                <th width="20%">Etiqueta</th>
                <th width="1%"></th>
                <th width="8%">P. Venta Sug.</th>
                <th width="8%">P. Compra</th>
				<th width="20%">&nbsp;</th>
			</tr>
		</thead>

		<tbody>
            <?php $i=0 ?> 

			@foreach ($productos as $producto)
				<tr>
                    <td>{{{ $producto->codprovider3 }}}</td>
                    <td>{{{ $producto->codproducto31 }}}</td>
                    <td><input style="visibility:hidden;" type="text" name="producto_id[]" id="producto_id[]" value="{{$producto->id}}" class="form-control" readonly tabindex="-1"></td>
                    <td><input type="text" name="precioventa[]" id="precioventa[]"value="{{$producto->precioventa}}" class="form-control"></td>
                    <td>{{{ $producto->preciocompra }}}</td>


                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('productos.destroy', $producto->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger',  'tabindex'=>'-1')) }}
                        {{ Form::close() }}


                    </td>
                    <?php $i=$i+1 ?>
				</tr>
			@endforeach
           
		</tbody>
	</table>
<div class="row">

    <div class="col-lg-5">

    </div>      
    <div class="col-lg-2">
                <button type="submit" id="editarbotton" class="btn btn-info">Editar Precio Sugerido</button>
    </div><!-- /.col-lg-6 -->     
</div>
@else
	No hay productos para mostrar
@endif

</form>
@stop

@section('scripts')

<script>


    $(document).ready(function() {

        $("#formulario").validate({
            rules: {
                'precioventa[]': {
                    required:true,
                    max: 500,
                    number:true
                }
            },
            messages: {
            }
        });
    });
</script>
@stop
