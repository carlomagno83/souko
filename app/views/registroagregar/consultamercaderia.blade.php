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

@foreach ($detalles as $detalle)
<div class="alert alert-info" >
    <div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="cantidaditem"># mercadería</span>
                <input type="text"  value="{{$detalle->id}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>       
        <div class="col-lg-6">
            <div class="input-group">
                <span class="input-group-addon" id="cantidaditem">Cod Producto 31</span>
                <input type="text"  value="{{$detalle->codproducto31}}" readonly class="form-control" tabindex="-1">
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


    </div>
</div>
@endforeach




<table class="table table-striped">
    <thead>
        <tr>
            <th width="15%"># Documento</th>
            <th></th>
            <th width="25%">Movimiento</th>             
            <th width="25%">Local</th>
            <th width="15%">Fecha creación doc</th>
            <th width="20%">Fecha sistema</th>


        </tr>    
    </thead>


        @foreach ($mercaderias as $mercaderia)
        <tr>
            <td width="15%"><input type="text" name="id[]" id="id[]" value="{{$mercaderia->Numdoc}}" class="form-control" readonly tabindex="-1"></td>
            <td><input style="visibility:hidden;" type="text"  name="codproducto31[]" value="{{$mercaderia->tipomovimiento_id}}" readonly class="form-control" tabindex="-1"></td>
            <td width="25%"><input type="text"  value="{{$mercaderia->destipomovimiento}}" readonly class="form-control" tabindex="-1"></td>
            <td width="10%"><input type="text"  value="{{$mercaderia->codlocal3}}" readonly class="form-control" tabindex="-1"></td>
            <td width="15%"><input type="text"  value="{{$mercaderia->fechadocumento}}" readonly class="form-control" tabindex="-1"></td>
            <td width="20%"><input type="text"  value="{{$mercaderia->created_at}}" readonly class="form-control" tabindex="-1"></td>
        </tr>
        @endforeach
</table>


@stop


