@extends('layouts.scaffold')

@section('main')


<script>
$(function() {
$( "#datepicker1" ).datepicker();
$( "#datepicker1" ).datepicker("setDate","0" );
$( "#datepicker1" ).datepicker('option', {dateFormat: 'yy/mm/dd'});
});  

</script>


<script type="text/javascript">
$(document).ready(function(){
  $("#storebutton").click(function(){

    if( $( "#datepicker1" ).val() =="" )    //valida campo 
    {
        alert("Ingrese fecha")
        return false
    }

    $(this).hide();
    $("#muestramsg").show();
    return true;});
 });
</script>


{{--<div align="right">--}}
    {{--<a id="home" href=" {{ URL::to('/') }} "><img src='img/home.ico' border='0'></a>--}}
{{--</div>--}}
<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Ingreso de mercadería desde el proveedor</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

<br>

<form method="POST" action="{{url('ingresos-proveedor-filtrar')}}">
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
<form method="POST" action="{{url('ingresos-proveedor-agregar')}}">
@if (count($productos)>0)

<!-- HTML Example by Way2Tutorial.com -->
<section style="border:3px solid black; background-color:#D8D8D8">
<h2>Escoja el producto a adicionar, incluya cantidades y precios </h2>
<h4>(Si ingresa sólo un parámetro, el registro no se grabará)</h4>
    <table class="table table-striped">
        <thead>
            <tr> 
                <th width="10%">Proveedor</th>
                <th width="10%">Producto</th>
                <th>Etiqueta</th>
                <th width="10%">P. Sug Venta</th>
                <th width="10%">Ultimo Precio</th>
                <th width="8%">Cantidad</th>
                <th width="15%">P. Compra</th>


            </tr>
        </thead>

        <tbody>
        
            @foreach ($productos as $producto)
                <tr>
                    <td width="10%">{{{ $producto->codprovider3 }}}</td>
                    <td width="15%"><input type="text" name="producto_id[]" id="producto_id[]" value="{{ $producto->id }}" readonly class="form-control" tabindex="-1"></td>
                    <td><input type="text" name="codproducto31[]" id="codproducto31[]" value="{{ $producto->codproducto31 }}" readonly class="form-control" tabindex="-1"></td>
                    <td><input type="text" id="preciosug[]" value="{{ $producto->precioventa }}" readonly class="form-control" tabindex="-1"></td>
                    <td><input type="text" name="ultimoprecio[]" id="ultimoprecio[]" value="{{ $producto->preciocompra }}" readonly class="form-control" tabindex="-1"></td>
                    <td width="8%"><input type="text" name="cantidad[]" id="cantidad[]" class="form-control"></td>
                    <td width="15%"><input type="text" name="preciocompra[]" id="preciocompra[]" class="form-control"></td>

                </tr>
            @endforeach
           
        </tbody>
    </table>
<div class="row">
    <div class="col-lg-9">
    </div>

    <div class="col-lg-3">
        <input type="submit" value="Ingresa Productos" class="btn btn-lg btn-success">
    </div>
</div>        
<br><br>
</section>    
@endif 

<br>
</form>
<form method="POST" action="{{url('ingresos-proveedor-store')}}">
@if (count($entradas)>0)
<h2>Productos para ingresar a Almacén</h2>
    <table class="table table-striped">
        <thead>
            <tr> 
                <th width="0%"></th>
                <th width="12%">Producto</th>
                <th>Etiqueta</th>
                <th width="7%">Cantidad</th>
                <th width="12%">Ultimo Precio</th>
                <th width="12%">Precio Compra</th>
            </tr>
        </thead>

        <tbody>
        
            @foreach ($entradas as $entrada)
                <tr>
                    <td width="0%"><input type="hidden" name="id[]" id="id[]" value="{{ $entrada->id }}" readonly class="form-control"></td>
                    <td width="12%"><input type="text" name="producto_id[]" id="producto_id[]" value="{{ $entrada->producto_id }}" readonly class="form-control" tabindex="-1"></td>
                    <td><input type="text" name="codproducto31[]" id="codproducto31[]" value="{{ $entrada->codproducto31 }}" readonly class="form-control" tabindex="-1"></td>
                    <td width="7%"><input type="text" name="cantidad[]" id="cantidad[]" value="{{ $entrada->cantidad }}" readonly class="form-control" tabindex="-1"></td>
                    @if ($entrada->ultimoprecio < $entrada->preciocompra)
                        <td width="12%" class="danger"><input type="text" name="ultimoprecio[]" id="ultimoprecio[]" value="{{ $entrada->ultimoprecio }}" readonly class="form-control" tabindex="-1"></td>
                        <td width="12%" class="danger"><input type="text" name="preciocompra[]" id="preciocompra[]" value="{{ $entrada->preciocompra }}" readonly class="form-control" tabindex="-1"></td>
                    @elseif ($entrada->ultimoprecio > $entrada->preciocompra)
                        <td width="12%" class="info"><input type="text" name="ultimoprecio[]" id="ultimoprecio[]" value="{{ $entrada->ultimoprecio }}" readonly class="form-control" tabindex="-1"></td>
                        <td width="12%" class="info"><input type="text" name="preciocompra[]" id="preciocompra[]" value="{{ $entrada->preciocompra }}" readonly class="form-control" tabindex="-1"></td>
                    @elseif ($entrada->ultimoprecio = $entrada->preciocompra)
                        <td width="12%"><input type="text" name="ultimoprecio[]" id="ultimoprecio[]" value="{{ $entrada->ultimoprecio }}" readonly class="form-control" tabindex="-1"></td>
                        <td width="12%"><input type="text" name="preciocompra[]" id="preciocompra[]" value="{{ $entrada->preciocompra }}" readonly class="form-control" tabindex="-1"></td>
                    @endif 
                    <td><a id="link_delete" href=" {{ URL::to('ingresoproveedor/delete/'.$entrada->id) }} ">Eliminar</a>  </td>

                </tr>
            @endforeach
           
        </tbody>
    </table>
<br>
<?php $cantidad = DB::table('entradas')->sum('cantidad'); $ptotal = DB::table('entradas')->selectRaw('SUM(cantidad * preciocompra) as total')->pluck('total');; ?>
<div class="alert alert-success" >
    <div class="row">
        <!--<div class="col-lg-5">-->

        <div class="col-lg-5">
        <div class="input-group">
            <span class="input-group-addon" id="numdocfisico">Número de Documento Físico</span>
            <input type="text" name="numdocfisico" class="form-control" placeholder="" aria-describedby="basic-addon1">
        </div>
        
        </div>
        <div class="col-lg-2">
                    CANTIDAD TOTAL:
        </div><!-- /.col-lg-6 -->     
        <div class="col-lg-1">
                    <strong>{{ $cantidad}} </strong>
        </div><!-- /.col-lg-6 -->    
        <div class="col-lg-1">
                    
        </div><!-- /.col-lg-6 -->   
        <div class="col-lg-2">
                    PRECIO TOTAL:
        </div><!-- /.col-lg-6 -->   
        <div class="col-lg-1">
                    <strong>{{ $ptotal }} </strong>
        </div><!-- /.col-lg-6 -->   
    </div> 
    <br>
    <div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="fechadocumento">Fecha</span>
                <input type="text" id="datepicker1" name="fechadocumento" class="form-control" aria-describedby="basic-addon1" required>
            </div>
        </div><!-- /.col-lg-6 --> 
    </div>  
    <div class="row">      
        <div class="col-lg-3">
                Fecha Sugerida = Fecha actual
        </div>
    </div>    

</div>    

<br>
    
    <input id="storebutton" type="submit" value="Actualizar Datos e imprimir Etiquetas" class="btn btn-lg btn-primary">
    <input id="muestramsg" style="display:none;" type="submit" value="Finalizado, espere la descarga del Archivo Excel ..." class="btn btn-lg btn-success" disabled>

</form>
@endif
<br>
<br>
@stop

@stop


