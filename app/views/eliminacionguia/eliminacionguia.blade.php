@extends('layouts.scaffold')

@section('main')

<script type="text/javascript">
$(document).ready(function(){
  $("#storebutton").click(function(){
    $(this).val('Finalizado, haga click para continuar');
    $(this).addClass('btn btn-success');
    return true;});
});
</script>

{{--<div align="right">--}}
    {{--<a id="home" href=" {{ URL::to('/') }} "><img src='img/home.ico' border='0'></a>--}}
{{--</div>--}}
<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Elimina Guía de Ingreso a Almacén</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>


<form method="POST" action="{{url('eliminacionguia-create')}}">

    <div class="row">
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="documento_id">Número de documento</span>
                <input type="text" class="form-control" name="documento_id" Input::old('documento_id') aria-describedby="basic-addon1">
            </div>
        </div><!-- /.col-lg-6 -->

        <div class="col-lg-6">
            <div class="input-group">
                <input type="submit" value="Buscar Documento" class=" btn btn-success"> 
            </div>
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
    <div class="row">
    </div><!-- /.row -->
    <br>
</form>

<form method="POST" action="{{url('eliminacionguia-createfisico')}}">

    <div class="row">
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="documento_id">Documento Físico</span>
                <input type="text" class="form-control" name="numdocfisico" Input::old('numdocfisico') aria-describedby="basic-addon1">
            </div>
        </div><!-- /.col-lg-6 -->

        <div class="col-lg-6">
            <div class="input-group">
                <input type="submit" value="Buscar por Documento Físico" class=" btn btn-success"> 
            </div>
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
    <div class="row">
    </div><!-- /.row -->
    <br>
</form>

<form method="POST" action="{{url('eliminacionguia-store')}}">
<?php $ok = 0 ?>
@if (count($documentos)>0)
@foreach ($documentos as $documento)
<h4>
    <div class="row">
        <div class="col-lg-2">
            <div class="input-group">
                <h4>Documento #</h4>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="input-group">
                 <input type="text" name="documento_id" id="documento_id" value="{{$documento->id}}" class="form-control" readonly tabindex="-1">
            </div>
        </div>
        <div class="col-lg-1">
            <div class="input-group">
                <h4>Fecha :</h4>  
            </div>
        </div>
        <div class="col-lg-2">
            <div class="input-group">
                <input type="text" value="{{$documento->fechadocumento }}" class="form-control" readonly tabindex="-1">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="input-group">
                <h4>Documento Físico :</h4>  
            </div>
        </div>
        <div class="col-lg-2">
            <div class="input-group">
                <input type="text" value="{{$documento->numdocfisico }}" class="form-control" readonly tabindex="-1">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group">
                   <h4> Total Items : {{count($mercaderias)}}</h4>
            </div>
        </div>   
    </div>         
</h4>
@endforeach
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th width="10%">Mercadería id</th>
            <th width="20%">Producto id</th>
            <th>Descripción cod31</th>
            <th width="15%">Precio Compra</th>
            <th width="15%">Local</th>
        </tr>    
    </thead>

@if (count($mercaderias)>0)
        @foreach ($mercaderias as $mercaderia)
        <tr>
            <td width="20%"><input type="text" name="id[]" id="id[]" value="{{$mercaderia->id}}" class="form-control" readonly tabindex="-1"></td>
            <td width="10%"><input type="text" name="producto_id[]" id="producto_id[]" value="{{$mercaderia->producto_id}}" readonly class="form-control" tabindex="-1"></td>
            <td><input type="text"  value="{{$mercaderia->codproducto31}}" readonly class="form-control" tabindex="-1"></td>
            <td width="15%"><input type="text"  value="{{$mercaderia->preciocompra}}" readonly class="form-control" tabindex="-1"></td>
            @if ($mercaderia->deslocal=='ALMACEN')
                <td width="15%"><input type="text"  value="{{$mercaderia->deslocal}}" readonly class="form-control" tabindex="-1"></td>
            @else
                <?php $ok = $ok + 1; ?>
                <td class="danger" width="15%"><input value="{{ $mercaderia->deslocal }}" readonly class="form-control" tabindex="-1"></td>
            @endif  

        </tr>
        @endforeach
    
</table>
@if($ok == 0)
    <div class="col-lg-4">
    <input id="storebutton" type="submit" value="Borrar documento en caso de diferencia de cantidades" class="btn btn-danger">
    </div>  
@endif    
<br>
<br>

<br>
<br>
@endif

</form>

@stop


