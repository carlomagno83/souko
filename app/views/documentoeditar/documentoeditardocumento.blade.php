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

<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Correcciones - Editar documento - muestra detalle</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>
<form method="POST" id="validadorjs" action="{{url('documentoeditardocumento')}}">
<br>
@foreach ($documentos as $documento)

<div class="row">
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="documento_id"># Documento</span>
            <input type="text" name="documento_id" class="form-control" value="{{$documento->id}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">
       </div>
    </div><!-- /.col-lg-6 -->  
    <div class="col-lg-5">
        <div class="input-group">
            <span class="input-group-addon" id="fechadocumento">Fecha Documento (yyyy-mm-dd)</span>
            <input type="text" name="fechadocumento" class="form-control" value="{{$documento->fechadocumento}}" aria-describedby="basic-addon1" >
       </div>
    </div><!-- /.col-lg-6 -->
</div>
<br>
<div class="row">
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="destipomovimiento">Guía de :</span>
            <input type="text" class="form-control" value="{{$documento->destipomovimiento}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">
       </div>    
    </div><!-- /.col-lg-6 -->  
    <div class="col-lg-5">
        <div class="input-group">
            <span class="input-group-addon" id="fechadocumento">Fecha Sistema (yyyy-mm-dd hh:mm:ss)</span>
            <input type="text" name="created_at" class="form-control" value="{{$documento->created_at}}" aria-describedby="basic-addon1" >
       </div>
    </div><!-- /.col-lg-6 -->    
    <div class="col-lg-2">
        <div class="input-group" style="visibility:hidden;">
            <span class="input-group-addon" id="fechadocumento">Tipo de mov id</span>
            <input type="text" name="tipomovimiento_id" class="form-control" value="{{$documento->tipomovimiento_id}}" aria-describedby="basic-addon1" >
       </div>
    </div><!-- /.col-lg-6 -->    
</div><!-- /.row -->
<br>
<div class="row">
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="local">Local</span>
            <input type="text"class="form-control" value="{{$documento->deslocal}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">
       </div>
    </div><!-- /.col-lg-6 -->  
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="desusuario">Emisor de documento</span>
            <input type="text" class="form-control" value="{{$documento->desusuario}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">
       </div>
    </div><!-- /.col-lg-6 -->


</div><!-- /.row -->
<br>

<?php $localdocumento = $documento->deslocal ?>

@endforeach

<table class="table table-striped">
    <thead>
        <tr>
            <th width="15%">Mercadería id</th>
            <th width="30%">Codproducto31</th>
            <th width="10%">Estado</th>             
            <th width="10%">Precio Compra</th>
            <th width="10%">Precio Venta</th>
            <th width="20%">Usuario</th> 

        </tr>    
    </thead>

@if (count($devuelves)>0)

        @foreach ($devuelves as $devuelve)
        <tr>
            <td width="15%"><input type="text" id="id[]" value="{{$devuelve->id}}" class="form-control" readonly tabindex="-1"></td>
            <td width="30%"><input type="text"  value="{{$devuelve->codproducto31}}" readonly class="form-control" tabindex="-1"></td>
            <td width="10%"><input type="text"  value="{{$devuelve->estado}}" readonly class="form-control" tabindex="-1"></td>
            <td width="10%"><input type="text"  value="{{$devuelve->preciocompra}}" readonly class="form-control" tabindex="-1"></td>
            <td width="10%"><input type="text"  value="{{$devuelve->precioventa}}" readonly class="form-control" tabindex="-1"></td>
            <td width="20%"><input type="text"  value="{{$devuelve->desusuario}}" readonly class="form-control" tabindex="-1"></td>

            <td><a href="consultamercaderia/{{$devuelve->id}}"  target="_blank">Consulta</a></td>
        </tr>
        @endforeach
</table>



<div class="row">
    <div class="col-lg-4">
        <input id="storebutton" type="submit" value="Editar Documento" class="btn btn-danger">
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


