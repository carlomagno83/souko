@extends('layouts.scaffold')

@section('main')

<script>
    $("form").ready(function() 
    {
        $("#validadorjs").validate(
        {
            rules: 
            {
                'precioventa[]' : {
                                    required: true,
                                    max: 500,
                                    number: true
                                  }
            },
            messages: 
            {
            }
        }
        );
    }
    );
</script>


<script type="text/javascript">
//alert("entraaboton")
$(document).ready(function(){
    $("#storebutton").click(function(){
    $(this).hide();
    $("#muestramsg").show();
    return true;});
});
</script>


<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Correcciones - Editar Guía de Ingreso Proveedor (Precio Compra)</h3>
        Valores pueden ser cero(0) en caso de devolución al proveedor
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
@foreach ($documentos as $documento)
<div class="row">
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="documento_id"># Documento</span>
            <input type="text" name="documento_id" class="form-control" value="{{$documento->id}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">
       </div>
    </div><!-- /.col-lg-6 -->  
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="fechadocumento">Fecha Documento</span>
            <input type="text" name="fechadocumento" class="form-control" value="{{$documento->fechadocumento}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">
       </div>
    </div><!-- /.col-lg-6 -->
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" >Total Items</span>
            <input type="text" class="form-control" value="{{count($devuelves)}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">
       </div>   
    </div>    
</div><!-- /.row -->
<br>
<div class="row">
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="local">Local</span>
            <input type="text" name="local" class="form-control" value="{{$documento->codlocal3}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">
       </div>
    </div><!-- /.col-lg-6 -->  
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="desusuario">Emisor de documento</span>
            <input type="text" name="desusuario" class="form-control" value="{{$documento->desusuario}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">
       </div>
    </div><!-- /.col-lg-6 -->
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" >Total Precio Compra</span>
            <input type="text" class="form-control" value="{{$documento->totalcompra}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">
       </div>
    </div><!-- /.col-lg-6 -->    
<input type="text" style="visibility:hidden" name="localfin_id" value="{{$documento->localfin_id}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">
<input type="text" style="visibility:hidden" name="usuario_id" value="{{$documento->usuario_id}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">

</div><!-- /.row -->
<br>

<?php $localdocumento = $documento->codlocal3 ?>

@endforeach

<table class="table table-striped">
    <thead>
        <tr>
            <th width="15%">Mercadería id</th>
            <th width="30%">Codproducto31</th>
            <th width="10%">Estado</th>   
            <th width="10%">Precio Compra</th>          
            <th width="10%">P Sugerido</th>
            
            <th width="20%">Usuario</th> 
        </tr>    
    </thead>

<form method="POST" id="validadorjs" action="{{url('ingresoeditarcompra')}}">
@if (count($devuelves)>0)
    @foreach ($devuelves as $devuelve)
        <tr>
            <td width="15%"><input type="text" name="id[]" id="id[]" value="{{$devuelve->id}}" class="form-control" readonly tabindex="-1"></td>
            <td width="30%"><input type="text"  value="{{$devuelve->codproducto31}}" readonly class="form-control" tabindex="-1"></td>

            <td width="10%"><input type="text"  value="{{$devuelve->estado}}" readonly class="form-control" tabindex="-1"></td>
            <td width="10%"><input type="number" name="preciocompra[]" id="preciocompra[]" value="{{$devuelve->preciocompra}}" min=1 max=500 class="form-control" required></td>
            <td width="10%"><input type="text"  value="{{$devuelve->preciosugerido}}" readonly class="form-control" tabindex="-1"></td>
            

            
            
            <td width="20%"><input type="text"  value="{{$devuelve->desusuario}}" readonly class="form-control" tabindex="-1"></td>
        </tr>
    @endforeach
</table>

<div class="row">
    <div class="col-lg-4">
        <input id="storebutton" type="submit" value="Editar precios" class="btn btn-danger">
    </div>
</div>    
<div class="row">
    <div class="col-lg-4">
        <input id="muestramsg" style="display:none;" type="submit" value="Finalizado..." class="btn btn-lg btn-success" disabled>
    </div>
    <div class="col-lg-8">
    </div>
</div>     
</form>
<br>

@endif

@stop


