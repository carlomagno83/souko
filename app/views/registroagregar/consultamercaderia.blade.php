@extends('layouts.scaffold')

@section('main')

<script src="../lib/jquery.js"></script>
<script src="../dist/jquery.validate.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  $("#storebutton").click(function(){
    $(this).hide();
    $("#muestramsg").show();
    return true;});
 });
</script>

<form method="POST" action="{{url('imprimeetiqueta')}}">
@foreach ($detalles as $detalle)
<div class="alert alert-info" >
    <div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon"># mercadería</span>
                <input type="text" name="id" value="{{$detalle->id}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>       
        <div class="col-lg-6">
            <div class="input-group">
                <span class="input-group-addon" >Cod Producto 31</span>
                <input type="text" name="codproducto31" value="{{$detalle->codproducto31}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>       
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="cantidaditem">Estado</span>
                <input type="text"  value="{{$detalle->estado}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>
        <br>
        <br>
        <br>       
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="cantidaditem">Precio Compra</span>
                <input type="text"  value="{{$detalle->preciocompra}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>       
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="cantidaditem">Precio Venta</span>
                <input type="text"  value="{{$detalle->precioventa}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>       
        <div class="col-lg-6"  align="right">
            <div class="input-group">
                <input type="image" name="submit" title="Imprime etiqueta en caso de pérdida" src="{{asset('img/barcode.png')}}" onclick="return confirm('¿Desea imprimir la etiqueta de código de barras para esta mercadería?');">
            </div>
        </div> 

    </div>
</div>
@endforeach
</form>


<?php 
    $cantidad_locales = DB::table('locals')->count('id');
    $locals = DB::table('locals')->select('id', 'codlocal3')->orderby('id')->get();
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th width="15%"># Documento</th>
            <th></th>
            <th width="25%">Movimiento</th>             
            <th width="12%">Origen</th>
            <th width="12%">Destino</th>
            <th width="15%">Fecha creación doc</th>
            <th width="20%">Fecha sistema</th>


        </tr>    
    </thead>


        @foreach ($mercaderias as $mercaderia)
        <tr>
            <td width="15%"><input type="text" name="id[]" id="id[]" value="{{$mercaderia->Numdoc}}" class="form-control" readonly tabindex="-1"></td>
            <td><input style="visibility:hidden;" type="text"  name="codproducto31[]" value="{{$mercaderia->tipomovimiento_id}}" readonly class="form-control" tabindex="-1"></td>
            @if ($mercaderia->devolucion < 0)
                <td width="12%"><input type="text"  value="CAMBIO CLIENTE (R. VENTA)" readonly class="form-control" tabindex="-1"></td>
            @else
                <td width="12%"><input type="text"  value="{{$mercaderia->destipomovimiento}}" readonly class="form-control" tabindex="-1"></td>
            @endif 
            @if ($mercaderia->tipomovimiento_id==4 or $mercaderia->tipomovimiento_id==6) 
                <td width="12%"><input type="text"  value="{{$locals[$mercaderia->origen - 1]->codlocal3}}" readonly class="form-control" tabindex="-1"></td>
            @else
                <td width="12%"><input type="text"  value="" readonly class="form-control" tabindex="-1"></td>
            @endif               
            <td width="10%"><input type="text"  value="{{$mercaderia->codlocal3}}" readonly class="form-control" tabindex="-1"></td>
            <td width="15%"><input type="text"  value="{{$mercaderia->fechadocumento}}" readonly class="form-control" tabindex="-1"></td>
            <td width="20%"><input type="text"  value="{{$mercaderia->created_at}}" readonly class="form-control" tabindex="-1"></td>
        </tr>
        @endforeach
</table>


@stop


