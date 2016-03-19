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
        <h3>Correcciones - Eliminar registro (Paso 2)</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>
<form method="POST" id="validadorjs" action="{{url('registroeliminarregistro')}}">
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
            <input type="text" class="form-control" value="{{$documento->fechadocumento}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">
       </div>
    </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<br>
<div class="row">
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="local">Local</span>
            <input type="text" class="form-control" value="{{$documento->deslocal}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">
       </div>
    </div><!-- /.col-lg-6 -->  
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="desusuario">Emisor de documento</span>
            <input type="text" class="form-control" value="{{$documento->desusuario}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">
       </div>
    </div><!-- /.col-lg-6 -->
<input type="text" style="visibility:hidden" value="{{$documento->localfin_id}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">
<input type="text" style="visibility:hidden" value="{{$documento->usuario_id}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">
<input type="text" style="visibility:hidden" name="tipomovimiento_id" value="{{$documento->tipomovimiento_id}}" aria-describedby="basic-addon1" readonly="" tabindex="-1">

</div><!-- /.row -->
<br>

    <?php 
        $localdocumento = $documento->deslocal; 
        $eliminardocumento_id = $documento->id; 
        $eliminardocumento_tipomovimiento = $documento->tipomovimiento_id; 
    ?>

@endforeach

@foreach ($mercaderias as $mercaderia)
    <?php $mercaderiaaeliminar = $mercaderia->id ?>
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
        <?php $mercaderiadoc = $devuelve->id ?>
        <tr>
            @if ($mercaderiaaeliminar == $mercaderiadoc)
                <td width="15%" class="info"><input type="text"  value="{{$devuelve->id}}" class="form-control" readonly tabindex="-1"></td>
                <td width="30%" class="info"><input type="text"  value="{{$devuelve->codproducto31}}" readonly class="form-control" tabindex="-1"></td>
                <td width="10%" class="info"><input type="text"  value="{{$devuelve->estado}}" readonly class="form-control" tabindex="-1"></td>
                <td width="10%" class="info"><input type="text"  value="{{$devuelve->preciocompra}}" readonly class="form-control" tabindex="-1"></td>
                <td width="10%" class="info"><input type="text"  value="{{$devuelve->precioventa}}" readonly class="form-control" tabindex="-1"></td>
                <td width="20%" class="info"><input type="text"  value="{{$devuelve->desusuario}}" readonly class="form-control" tabindex="-1"></td>
                <td><input style="visibility:hidden;" type="text" name="mercaderialocal_id" id="mercaderialocal_id" value="{{$devuelve->local_id}}" class="form-control" readonly tabindex="-1"></td>
                <td><input style="visibility:hidden;" type="text" name="mercaderiausuario_id" id="mercaderiausuario_id" value="{{$devuelve->usuario_id}}" class="form-control" readonly tabindex="-1"></td>

            @else

                <td width="15%"><input type="text" id="id[]" value="{{$devuelve->id}}" class="form-control" readonly tabindex="-1"></td>
                <td width="30%"><input type="text"  value="{{$devuelve->codproducto31}}" readonly class="form-control" tabindex="-1"></td>
                <td width="10%"><input type="text"  value="{{$devuelve->estado}}" readonly class="form-control" tabindex="-1"></td>
                <td width="10%"><input type="text"  value="{{$devuelve->preciocompra}}" readonly class="form-control" tabindex="-1"></td>
                <td width="10%"><input type="text"  value="{{$devuelve->precioventa}}" readonly class="form-control" tabindex="-1"></td>
                <td width="20%"><input type="text"  value="{{$devuelve->desusuario}}" readonly class="form-control" tabindex="-1"></td>
                <td><input style="visibility:hidden;" type="text" name="mercaderialocal_id" id="mercaderialocal_id" value="{{$devuelve->local_id}}" class="form-control" readonly tabindex="-1"></td>
                <td><input style="visibility:hidden;" type="text" name="mercaderiausuario_id" id="mercaderiausuario_id" value="{{$devuelve->usuario_id}}" class="form-control" readonly tabindex="-1"></td>

            @endif    
        </tr>
        @endforeach
</table>
@endif

@foreach ($ultimos as $ultimo)
<?php
    $permite = 0;
    $ultimodoc_id = $ultimo->Numdoc;
    $ultimotipomovimiento_id = $ultimo->tipomovimiento_id;
    if ( $eliminardocumento_id == $ultimodoc_id and $eliminardocumento_tipomovimiento == $ultimotipomovimiento_id )
    {
        $permite = $permite +1;
    }  
  
?>
@endforeach

@foreach ($mercaderias as $mercaderia)
            <td><input  style="visibility:hidden; type="text" name="mercaderia_id" id="mercaderia_id" value="{{$mercaderia->id}}" class="form-control" readonly tabindex="-1"></td>
@endforeach


<div class="alert alert-success" >
@if ($permite > 0)
<div class="row">
    <div class="col-lg-4">
        <input id="storebutton" type="submit" value="Eliminar mercadería " class="btn btn-danger">
    </div>
</div>    
<div class="row">
    <div class="col-lg-4">
    <input id="muestramsg" style="display:none;" type="submit" value="Finalizado..." class="btn btn-lg btn-success" disabled>
    </div>
    <div class="col-lg-8">
    </div>
</div>   
@endif  

</form>
<br>



@foreach ($mercaderias as $mercaderia)
<div class="row">
    <div class="col-lg-4">
        <input type="text"  style="visibility:hidden;" name="mercaderia_id" id="mercaderia_id" value="{{$mercaderia->id}}" class="form-control" readonly tabindex="-1">
        <a href="consultamercaderia/{{$mercaderia->id}}"  target="_blank">Presiona para consulta de historial de la mercaderia</a>
    </div>    
</div> 
@endforeach

</div>

@stop


