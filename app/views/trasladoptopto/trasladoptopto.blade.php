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
        <h3>Traslado de mercadería de un Punto de Venta a otro Punto de Venta</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

<form method="POST" id="validadorjs" action="{{url('trasladoptopto-agregareg')}}">
<br>
<div class="row">
    <div class="col-lg-5">
        <div class="input-group">
            <span class="input-group-addon" id="mercaderia_id">Mercadería</span>
            <input type="text" name='mercaderia_id' class="form-control" placeholder="Necesario #de merca en guia de traslado" aria-describedby="basic-addon1">
       </div>
    </div><!-- /.col-lg-6 -->  
    <!-- Botón para agregar filas -->
    <input type="submit" value="Agrega Mercaderia" class=" btn btn-success"> 
    
</div><!-- /.row -->
</form>
<br>
<form method="POST" id="validadorjs" action="{{url('trasladoptopto-store')}}">
<table class="table table-striped">
    <thead>
        <tr>
            <th width="10%">Mercadería id</th>
            <th width="8%">Producto id</th>
            <th>Descripción cod31</th>
            <th width="20%">Local actual</th>
            <th width="15%">Ultimo Usuario</th>
            <th width="7%">Estado</th>
        </tr>    
    </thead>

@if (count($traslados)>0)
<?php $deslocalini = DB::table('traslados')->select('deslocal')->pluck('deslocal');
    $localini_id = DB::table('locals')->select('id')->where('deslocal', '=', $deslocalini)->pluck('id');
 ?>
        @foreach ($traslados as $traslado)
        <tr>
            <td width="10%"><input type="text" name="mercaderia_id[]" id="mercaderia_id[]" value="{{$traslado->mercaderia_id}}" class="form-control" readonly tabindex="-1"></td>
            <td width="8%"><input type="text" name="producto_id[]" id="producto_id[]" value="{{$traslado->producto_id}}" readonly class="form-control" tabindex="-1"></td>
            <td><input type="text"  value="{{$traslado->codproducto31}}" readonly class="form-control" tabindex="-1"></td>
            @if ($traslado->deslocal=='ALMACEN')
                <td width="20%" class="danger"><input type="text"  value="{{$traslado->deslocal}}" readonly class="form-control" tabindex="-1"></td>
            @else
                @if(count($traslados)>1)
                    @if($traslado->deslocal == $deslocalini)
                        <td width="15%"><input type="text"  value="{{$traslado->deslocal}}" readonly class="form-control" tabindex="-1"></td>
                    @else
                        <td width="15%" class="danger"><input type="text"  value="{{$traslado->deslocal}}" readonly class="form-control" tabindex="-1"></td>
                    @endif
                @else
                    <td width="15%"><input type="text"  value="{{$traslado->deslocal}}" readonly class="form-control" tabindex="-1"></td>
                @endif    
            @endif            
            <td width="15%"><input type="text"  value="{{$traslado->desusuario}}" readonly class="form-control" tabindex="-1"></td>
            @if ($traslado->estado<>'ACT')
                <td width="7%" class="danger"><input type="text"  value="{{$traslado->estado}}" readonly class="form-control" tabindex="-1"></td>
            @else
                <td width="7%"><input type="text"  value="{{$traslado->estado}}" readonly class="form-control" tabindex="-1"></td>
            @endif

            <td><a id="link_delete" href=" {{ URL::to('trasladoptopto/delete/'.$traslado->mercaderia_id) }} ">Eliminar</a>  </td>
        </tr>
        @endforeach
    
</table>
<br>

<div class="row">
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="localini">Local Inicial</span>
                <input type="text" name="deslocalini" value={{ DB::table('traslados')->select('deslocal')->pluck('deslocal') }} readonly class="form-control" tabindex="-1">
           </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-1">
            <div class="input-group">
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-1">
            <div class="input-group">
                <a href="" tabindex="-1"><img src="img/arrow.png"></a> 
           </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-1">
            <div class="input-group">
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="localfin">Local Final</span>
                {{Form::select('localfin',[''=>''] + DB::table('locals')->where('deslocal','<>','ALMACEN')->where('id', '<>', $localini_id)->orderby('deslocal')->lists('deslocal','id'),null,array('class'=>'form-control', 'required'=>'required'))}}
           </div>
        </div><!-- /.col-lg-6 -->
</div><!-- /.row -->

<div class="row">
        <div class="col-lg-7">
            <div class="input-group">
                <input type="text" style="display: none;" name="localini" value={{ $localini_id }} readonly class="form-control">
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="marca_id">Solicitante</span>
                {{Form::select('usuario_id', [''=>''] + DB::table('users')->where('rolusuario',"VENDE")->orderby('desusuario')->lists('desusuario','id'),null,array('class'=>'form-control', 'required'=>'required'))}}
            </div>
        </div><!-- /.col-lg-6 -->
</div><!-- /.row -->

<div class="row">
        <div class="col-lg-7">
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="numdocfisico">Número de Documento Físico</span>
                <input type="text" name="numdocfisico" class="form-control" placeholder="" aria-describedby="basic-addon1">
            </div>
        </div>    
</div><!-- /.row -->

<br>
<br>
<div class="row">
    <div class="col-lg-4">
        <input id="storebutton" type="submit" value="Finalizar" class="btn btn-lg btn-primary">
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


