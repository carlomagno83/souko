@extends('layouts.scaffold')

@section('main')

<script type="text/javascript">
$(document).ready(function(){
  $("#storebutton").click(function(){
    $(this).hide();
    $("#muestramsg").show();
    return true;});
 });
</script>

<script>
$(function() {
$( "#datepicker1" ).datepicker();
$( "#datepicker1" ).datepicker("setDate","0" );
$( "#datepicker1" ).datepicker('option', {dateFormat: 'yy/mm/dd'});
});  
</script>


<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Generación de Guía de devolución para el Proveedor</h3>
        Último registro: {{DB::table('documentos')->select('id')->where('tipomovimiento_id','7')->orderBy('id', 'desc')->pluck('id')}}, doc físico : {{DB::table('documentos')->select('numdocfisico')->where('tipomovimiento_id','7')->orderBy('id', 'desc')->pluck('numdocfisico')}}
        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

<form method="POST" action="{{url('generaguiadev-filtrar')}}"><div class="row">
<br>
    <div class="col-lg-3">
        <div class="input-group">
            <span class="input-group-addon" id="desprovider">Proveedor</span>
            {{Form::select('desprovider', DB::table('providers')
                            ->join('productos', 'providers.id', '=', 'productos.provider_id')
                            ->join('mercaderias', 'productos.id', '=', 'mercaderias.producto_id')
                            ->where('mercaderias.estado', '=', 'INA')
                            ->groupBy('desprovider')
                            ->orderby('desprovider')->lists('desprovider', 'desprovider'), Input::get('desprovider'), array('class'=>'form-control', 'required'=>'required'))}}

        </div>
    </div><!-- /.col-lg-6 -->
    <input type="submit" value="Buscar Mercaderías para Devolución de Proveedor seleccionado" class="btn btn-info">  
</div><!-- /.row -->
<br>
</form>


<form method="POST" action="{{url('generaguiadev-agregareg')}}">
@if (count($mercaderias)>0)
<section style="border:3px solid black; background-color:#D8D8D8">
<table class="table table-striped">
    <thead>
        <tr>
            <th width="10%">Proveedor</th>
            <th width="10%">Mercadería id</th>
            <th>Descripción cod31</th>
            <th width="8%">Estado</th>
            <th width="15%">Local</th>
            <th width="8%">P. Compra</th>
            <th width="10%">Seleccione</th>
        </tr>    
    </thead>
    @if (count($mercaderias)>0)
        <?php $i=0; $totprecio=0; $bien=0; ?>
        @foreach ($mercaderias as $mercaderia)
        <tr>
            <td width="10%"><input type="text" name="codprovider3[]" id="mercaderia_id[]" value="{{$mercaderia->codprovider3}}" class="form-control" readonly tabindex="-1"></td>
            <td width="10%"><input type="text" name="mercaderia_id[]" id="mercaderia_id[]" value="{{$mercaderia->id}}" class="form-control" readonly tabindex="-1"></td>
            <td><input type="text" name="codproducto31[]" value="{{$mercaderia->codproducto31}}" readonly class="form-control" tabindex="-1"></td>
            @if ($mercaderia->estado=='ACT')
                <td width="8%"><input type="text" name="estado[]" value="{{$mercaderia->estado}}" readonly class="form-control" tabindex="-1"></td>
            @else
                <td width="8%" class="danger"><input type="text" name="estado[]" value="{{$mercaderia->estado}}" readonly class="form-control" tabindex="-1"></td>
            @endif              
            @if ($mercaderia->codlocal3=='ALM')
            <td width="15%"><input type="text" name="deslocal[]" value="{{$mercaderia->codlocal3}}" readonly class="form-control" tabindex="-1"></td>
            @else
            <td width="15%" class="danger"><input type="text" name="deslocal[]" value="{{$mercaderia->codlocal3}}" readonly class="form-control" tabindex="-1"></td>
            <?php $bien=$bien+1; ?>
            @endif            

            <td width="8%"><input type="text" name="preciocompra[]" value="{{$mercaderia->preciocompra}}" readonly class="form-control" tabindex="-1"></td>
            <td width="10%"><input type="checkbox" name="checkbox[{{$i}}]" class="form-control"/></td>
            <?php $i=$i+1; $totprecio = $totprecio + $mercaderia->preciocompra; ?>
        </tr>
        @endforeach
    @endif
</table>
<div class="row">
    <div class="col-lg-1">
    </div>
    <div class="col-lg-2">
    @if (count($mercaderias)>0)
        Total sin seleccionar : {{count($mercaderias)}}
    @endif
    </div>   
    <div class="col-lg-4">
    @if (count($mercaderias)>0)
        Total Precio de Compra s/seleccionar : {{number_format($totprecio,2)}}    
    @endif    
    </div>     
    <div class="col-lg-1">
    </div>     
   
    <div class="col-lg-3">
        @if($bien==0)
        <input type="submit" value="Agrega Mercaderías Seleccionadas" class="btn btn-lg btn-success">
        @endif
    </div>
</div>        
<br><br>
</section> 
@endif 
</form>
<br>
<br>
<form method="POST" action="{{url('generaguiadev-store')}}">
@if (count($devueltos)>0)
<table class="table table-striped">
    <thead>
        <tr>
            <th width="10%">Proveedor</th>
            <th width="10%">Mercadería id</th>
            <th>Descripción cod31</th>
            <th width="8%">Estado</th>
            <th width="10%">Local</th>
            <th width="8%">P. Compra</th>
        </tr>    
    </thead>
    @if (count($devueltos)>0)
        @foreach ($devueltos as $devuelto)
        <tr>
            <td width="10%"><input type="text" name="codprovider3[]" id="mercaderia_id[]" value="{{$devuelto->codprovider3}}" readonly class="form-control" tabindex="-1"></td>
            <td width="10%"><input type="text" name="mercaderia_id[]" id="mercaderia_id[]" value="{{$devuelto->mercaderia_id}}" readonly class="form-control" tabindex="-1"></td>
            <td><input type="text" name="codproducto31[]" value="{{$devuelto->codproducto31}}" readonly class="form-control" tabindex="-1"></td>
            @if ($devuelto->estado=='ACT')
                <td width="8%"><input type="text" name="estado[]" value="{{$devuelto->estado}}" readonly class="form-control" tabindex="-1"></td>
            @else
                <td width="8%" class="danger"><input type="text" name="estado[]" value="{{$devuelto->estado}}" readonly class="form-control" tabindex="-1"</td>
            @endif              

            <td width="10%"><input type="text" name="deslocal[]" value="{{$devuelto->deslocal}}" readonly class="form-control" tabindex="-1"></td>
            <td width="8%"><input type="text" name="preciocompra[]" value="{{$devuelto->preciocompra}}" readonly class="form-control" tabindex="-1"></td>

            <td width="5%"><a id="link_delete" href=" {{ URL::to('generaguiadev/delete/'.$devuelto->mercaderia_id) }} "><img width="30px" src="{{asset('img/eliminar.png')}}"></a></td>
            <td width="5%"><a href="{{URL::to('consultamercaderia/'.$devuelto->mercaderia_id)}}" target="_blank"><img width="30px" src="{{asset('img/lupa.png')}}"></a></td>
        </tr>
        @endforeach

    @endif
</table>
<br>
<div class="alert alert-success" >
    <div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="fechadocumento">Fecha</span>
                <input type="text" id="datepicker1" name="fechadocumento" class="form-control" aria-describedby="basic-addon1">
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-2">
        </div>   
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="numdocfisico">Número de Documento Físico</span>
                <input type="text" name="numdocfisico" class="form-control" placeholder="" aria-describedby="basic-addon1">
            </div>
        </div>    
    </div><!-- /.row -->
    <div class="row">    
        <div class="col-lg-3">
            <div class="input-group">
                Fecha Sugerida = Fecha Actual
            </div>    
        </div>
    </div>  
<br>

    <div class="row">    
        <div class="col-lg-1">
        </div>
        <div class="col-lg-3">
            @if (count($devueltos)>0)
                Total de items seleccionados : {{count($devueltos)}} 
            @endif          
        </div>
        <div class="col-lg-4">
            @if (count($devueltos)>0)
                <?php $totalprecio = DB::table('devueltos')->sum('preciocompra'); ?>
                Total Precio de Compra seleccionados : {{$totalprecio}} 
            @endif          
        </div>
    </div>
       
</div>
<div class="row">
    <div class="col-lg-4">
        <input id="storebutton" type="submit" value="Generar Guía con los productos seleccionados" class="btn btn-lg btn-primary">      
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
    <input id="muestramsg" style="display:none;" type="submit" value="Finalizado, espere la descarga del Archivo Excel ..." class="btn btn-lg btn-success" disabled>
    </div>
    <div class="col-lg-8">
    </div>
</div>       
@endif
<br>
<br>
</form>




@stop


