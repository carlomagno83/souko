@extends('layouts.scaffold')

@section('main')
<script src="../lib/jquery.js"></script>
<script src="../dist/jquery.validate.js"></script>
<script>
  // only for demo purposes
  $.validator.setDefaults({
    submitHandler: function() {
      alert("submitted!");
    }
  });

  $(document).ready(function() {
    $("#validadorjs").validate();
  });
</script>

<script type="text/javascript">
$(document).ready(function(){
  $("#storebutton").click(function(){
    $(this).hide();
    $("#muestramsg").show();
    return true;});
 });
</script>

<div align="right">
    <a id="home" href=" {{ URL::to('/') }} "><img src='img/home.ico' border='0'></a>
</div>
<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Registro de Ventas a final de día</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

<form method="POST" id="validadorjs" action="{{url('ventas-agregareg')}}">

<!-- llenando la tabla -->
<br>
<div class="row">
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="mercaderia_id">Mercadería</span>
            <input type="text" name="mercaderia_id" class="form-control" placeholder="Uso de pistola" aria-describedby="basic-addon1" required>
       </div>
    </div><!-- /.col-lg-6 -->  
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="precioventa">Precio de venta</span>
            <input type="text" name="precioventa" class="form-control" placeholder="" aria-describedby="basic-addon1" required>
       </div>
    </div><!-- /.col-lg-6 -->    
    <div class="col-lg-4">
    <input type="submit" value="Agrega Mercaderia" class=" btn btn-success"> 
    </div>
</div><!-- /.row -->
<br>
</form>

<form method="POST" id="validadorjs" action="{{url('ventas-store')}}">
<table class="table table-striped">
    <thead>
        <tr>
            <th width="10%">Mercadería id</th>
            <th width="10%">Producto id</th>
            <th>Descripción cod31</th>
            <th width="20%">Local actual</th>
            <th width="7%">Estado</th>
            <th width="10%">Precio Venta</th>
        </tr>    
    </thead>

@if (count($vendidos)>0)
<?php $deslocal=DB::table('vendidos')->select('deslocal')->pluck('deslocal'); ?>
        @foreach ($vendidos as $vendido)
        <tr>
            <td width="10%"><input type="text" name="mercaderia_id[]" id="mercaderia_id[]" value="{{$vendido->mercaderia_id}}" readonly class="form-control" tabindex="-1"></td>
            <td width="10%"><input type="text" name="producto_id[]" id="producto_id[]" value="{{$vendido->producto_id}}" readonly class="form-control" tabindex="-1"></td>
            <td><input type="text"  value="{{$vendido->codproducto31}}" readonly class="form-control" tabindex="-1"></td>
            @if ($vendido->deslocal=='ALMACEN')
                <td width="20%" class="danger"><input type="text" value="{{$vendido->deslocal}}" readonly class="form-control" tabindex="-1"></td>
            @else
                @if (count($vendidos)>1)
                    @if($vendido->deslocal==$deslocal)
                        <td width="20%"><input type="text" value="{{$vendido->deslocal}}" readonly class="form-control" tabindex="-1"></td>
                    @else
                        <td width="20%" class="danger"><input type="text" value="{{$vendido->deslocal}}" readonly class="form-control" tabindex="-1"></td>
                    @endif
                @else
                    <td width="20%"><input type="text" value="{{$vendido->deslocal}}" readonly class="form-control" tabindex="-1"></td>
                @endif
            @endif
            @if ($vendido->estado<>'ACT')
                <td width="7%" class="danger"><input type="text" name="estado[]" value="{{$vendido->estado}}" readonly class="form-control" tabindex="-1"></td>
            @else
                <td width="7%"><input type="text" name="estado[]" value="{{$vendido->estado}}" readonly class="form-control" tabindex="-1"></td>
            @endif
            @if ($vendido->estado=='VEN')
                <td width="10%" class="danger"><input type="text" name="precioventa[]" id="precioventa[]" value="-{{$vendido->precioventa}}" readonly class="form-control"></td>
            @else
                <td width="10%"><input type="text" name="precioventa[]" id="precioventa[]" value="{{$vendido->precioventa}}" readonly class="form-control" tabindex="-1"></td>
            @endif    
            <td><a id="link_delete" href=" {{ URL::to('ventas/delete/'.$vendido->mercaderia_id) }} ">Eliminar</a>  </td>
        </tr>
        @endforeach
    
</table>
<br>

<div class="row">
        <div class="col-lg-5">
            <div class="input-group">
                <span class="input-group-addon" id="usuario_id">Usuario Vendedor</span>
                {{Form::select('usuario_id', [''=>''] + DB::table('users')->where('rolusuario',"VENDE")->orderby('desusuario')->lists('desusuario','id'),null,array('class'=>'form-control', 'required'=>'required'))}}
            </div>
        </div><!-- /.col-lg-6 -->

        <div class="col-lg-5">
            <div class="input-group">
                <span class="input-group-addon" id="local_id">Local o Pto de Venta</span>
                {{Form::select('local_id',[''=>''] + DB::table('locals')->where('deslocal','<>','ALMACEN')->orderby('deslocal')->lists('deslocal','id'), $deslocal,array('class'=>'form-control', 'required'=>'required'))}}
           </div>
        </div><!-- /.col-lg-6 -->    
</div><!-- /.row -->
<br>
<div class="row">
    <div class="col-lg-4">
        <input id="storebutton" type="submit" value="Finalizar" class="btn btn-lg btn-primary">
    </div>
    <div class="col-lg-8">
    </div>
</div>    
<div class="row">
    <div class="col-lg-4">
    <input id="muestramsg" style="display:none;" type="submit" value="Finalizado, espere la descarga del Archivo Excel ..." class="btn btn-lg btn-success" disabled>
    </div>
    <div class="col-lg-8">
    </div>
</div>   
</form> 
<br>
<br>
<br>
<br>
@endif


@stop


