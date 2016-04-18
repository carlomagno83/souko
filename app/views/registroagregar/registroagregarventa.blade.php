@extends('layouts.scaffold')

@section('main')

<script src="../lib/jquery.js"></script>
<script src="../dist/jquery.validate.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  $("#storebutton").click(function(){
    if( $( "#precioventaregistro" ).val() == "" )    //valida campo 
    {
        alert("Ingrese el precio de venta");
        return false;
    }

    $(this).hide();
    $("#muestramsg").show();
    return true;});
 });
</script>





<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Correcciones - Agregar registro Venta</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>
<form method="POST" id="validadorjs" action="{{url('registroagregarventa')}}">
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
            <th width="10%">Precio Venta</th>
            <th width="20%">Usuario</th> 

        </tr>    
    </thead>

@if (count($devuelves)>0)

        @foreach ($devuelves as $devuelve)
        <tr>
            <td width="15%"><input type="text" name="id[]" id="id[]" value="{{$devuelve->id}}" class="form-control" readonly tabindex="-1"></td>
            <td width="30%"><input type="text"  name="codproducto31[]" value="{{$devuelve->codproducto31}}" readonly class="form-control" tabindex="-1"></td>
            <td width="10%"><input type="text"  value="{{$devuelve->estado}}" readonly class="form-control" tabindex="-1"></td>
            <td width="10%"><input type="text"  value="{{$devuelve->preciocompra}}" readonly class="form-control" tabindex="-1"></td>
            <td width="10%"><input type="text"  value="{{$devuelve->precioventa}}" readonly class="form-control" tabindex="-1"></td>
            <td width="20%"><input type="text"  value="{{$devuelve->desusuario}}" readonly class="form-control" tabindex="-1"></td>
            <td><input style="visibility:hidden;" type="text" name="mercaderialocal_id" id="mercaderialocal_id" value="{{$devuelve->local_id}}" class="form-control" readonly tabindex="-1"></td>
            <td><input style="visibility:hidden;" type="text" name="mercaderiausuario_id" id="mercaderiausuario_id" value="{{$devuelve->usuario_id}}" class="form-control" readonly tabindex="-1"></td>
        </tr>
        @endforeach
</table>
@foreach ($mercaderias as $mercaderia)
<?php  
$localmercaderia = $mercaderia->codlocal3;
$estadomercaderia = $mercaderia->estado;  
$foul = 0;
?>
<div class="alert alert-success" >

<table class="table table-striped">
    <thead>
        <tr>
            <th>Mercadería id</th>
            <th>Codproducto31</th>
            <th>Estado</th>             
            <th>Precio Sug</th>
            <th>Ult Usuario</th>
            <th>Local actual</th> 

        </tr>    
    </thead>
        <tr>
            <td width="12%"><input type="text" name="mercaderia_id" id="mercaderia_id" value="{{$mercaderia->id}}" class="form-control" readonly tabindex="-1"></td>
            <td width="30%"><input type="text" name="mercaderiacodproducto31" value="{{$mercaderia->codproducto31}}" readonly class="form-control" tabindex="-1"></td>
            @if ($estadomercaderia == 'ACT' || $estadomercaderia == 'INA')
                <td width="10%"><input type="text" name="estado" value="{{$mercaderia->estado}}" readonly class="form-control" tabindex="-1"></td>
            @else
                <td width="10%" class="danger"><input type="text" name="estado" value="{{$mercaderia->estado}}" readonly class="form-control" tabindex="-1"></td>
                <?php $foul = $foul + 1 ?>
            @endif
            <td width="10%"><input type="text" name="precioventa"  value="{{$mercaderia->precioventa}}" readonly class="form-control" tabindex="-1"></td>
            <td width="20%"><input type="text"  value="{{$mercaderia->desusuario}}" readonly class="form-control" tabindex="-1"></td>
            @if ($localmercaderia <> $localdocumento)
                <td width="10%" class="danger"><input type="text" value="{{$mercaderia->codlocal3}}" readonly class="form-control" tabindex="-1"></td>
                <?php $foul = $foul + 1 ?>
            @else
                <td width="10%"><input type="text" value="{{$mercaderia->codlocal3}}" readonly class="form-control" tabindex="-1"></td>
            @endif
            <td><input style="visibility:hidden; type="text" name="mercaderialocal_id" id="mercaderialocal_id" value="{{$mercaderia->local_id}}" class="form-control" readonly tabindex="-1"></td>
            <td><input style="visibility:hidden; type="text" name="mercaderiausuario_id" id="mercaderiausuario_id" value="{{$mercaderia->usuario_id}}" class="form-control" readonly tabindex="-1"></td>
        </tr>
</table>

<div class="alert alert-success" >
    <div class="row">
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="numdocfisico">Precio de venta</span>
                <input type="text" id="precioventaregistro" name="precioventaregistro" class="form-control" placeholder="" aria-describedby="basic-addon1" required autofocus>
            </div>
        </div>           
    </div><!-- /.row -->
</div>    

@endforeach

@if ($foul == 0)
<div class="row">
    <div class="col-lg-4">
        <input id="storebutton" type="submit" value="Agregar registro" class="btn btn-danger">
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

@endif

@foreach ($mercaderias as $mercaderia)
<div class="row">
    <div class="col-lg-4">
        <input type="text"  style="visibility:hidden;" name="mercaderia_id" id="mercaderia_id" value="{{$mercaderia->id}}" class="form-control" readonly tabindex="-1">
        <a href="consultamercaderia/{{$mercaderia->id}}"  target="_blank">Presiona para consulta de historial de la mercaderia</a>
    </div>    
</div> 
@endforeach


@stop


