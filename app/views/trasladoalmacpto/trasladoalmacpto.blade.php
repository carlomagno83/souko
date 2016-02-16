@extends('layouts.scaffold')

@section('main')

<script src="../lib/jquery.js"></script>
<script src="../dist/jquery.validate.js"></script>
<script>
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

{{--<div align="right">--}}
    {{--<a id="home" href=" {{ URL::to('/') }} "><img src='img/home.ico' border='0'></a>--}}
{{--</div>--}}
<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Traslado de mercadería a Pto de Venta desde Almacén</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>


<form method="POST" id="validadorjs" action="{{url('trasladoalmacpto-agregareg')}}">

<!-- llenando la tabla -->
<br>
<div class="row">
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="mercaderia_id">Mercadería</span>
            <input type="text" name="mercaderia_id" class="form-control" placeholder="Uso de pistola" aria-describedby="basic-addon1" autofocus>
       </div>
    </div><!-- /.col-lg-6 --> 
    <!-- Botón para agregar filas -->
    <input type="submit" value="Agrega Mercaderia" class=" btn btn-success"> 
    
</div><!-- /.row -->

<br>
</form>  

<form method="POST" id="validadorjs" action="{{url('trasladoalmacpto-store')}}">
<table class="table table-striped">
    <thead>
        <tr>
            <th width="10%">Mercadería id</th>
            <th width="10%">Producto id</th>
            <th>Descripción cod31</th>
            <th>Local Actual</th>
            <th width="10%">Estado</th>
        </tr>    
    </thead>

@if (count($tempos)>0)
        @foreach ($tempos as $tempo)
        <tr>
            <td width="10%"><input type="text" name="mercaderia_id[]" id="mercaderia_id[]" value="{{$tempo->mercaderia_id}}" class="form-control" readonly tabindex="-1"></td>
            <td width="10%"><input type="text" name="producto_id[]" id="producto_id[]" value="{{$tempo->producto_id}}" readonly class="form-control" tabindex="-1"></td>
            <td><input type="text"  value="{{$tempo->codproducto31}}" readonly class="form-control" tabindex="-1"></td>
            @if ($tempo->deslocal<>'ALMACEN')
                <td class="danger"><input type="text"  value="{{$tempo->deslocal}}" readonly class="form-control" tabindex="-1"></td>
            @else
                <td><input type="text"  value="{{$tempo->deslocal}}" readonly class="form-control" tabindex="-1"></td>
            @endif
                
            @if ($tempo->estado<>'ACT')
                <td width="10%" class="danger"><input type="text"  value="{{$tempo->estado}}" readonly class="form-control" tabindex="-1"></td>
            @else
                <td width="10%"><input type="text"  value="{{$tempo->estado}}" readonly class="form-control" tabindex="-1"></td>
            @endif
            
            <td><a id="link_delete" href=" {{ URL::to('trasladoalmacpto/delete/'.$tempo->mercaderia_id) }} ">Eliminar</a>  </td>
        </tr>
        @endforeach
    
</table>

<div class="row">
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="usuario_id">Vendedor</span>
            {{Form::select('usuario_id', [''=>''] + DB::table('users')->where('rolusuario',"VENDE")->orderby('desusuario')->lists('desusuario','id'), Input::get('usuario_id'), array('class'=>'form-control', 'required'=>'required'))}}
        </div>
    </div><!-- /.col-lg-6 -->

    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="local_id">Local</span>
            {{Form::select('local_id',[''=>''] + DB::table('locals')->where('deslocal','<>','ALMACEN')->orderby('deslocal')->lists('deslocal','id'), Input::get('local_id'), array('class'=>'form-control', 'required'=>'required'))}}
       </div>
    </div><!-- /.col-lg-6 -->

    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="numdocfisico">Número de Documento Físico</span>
            <input type="text" name="numdocfisico" class="form-control" placeholder="" aria-describedby="basic-addon1">
        </div>
    </div>    
</div>  
 <br>
 <br>
<div class="row">
    <div class="col-lg-4">
        <input id="storebutton" type="submit" value="Finalizar" class="btn btn-lg btn-primary">
    </div>
</div>    
<div class="row">
    <div>
        <input id="muestramsg" style="display:none;" type="submit" value="Finalizado, espere la descarga del Archivo Excel ..." class="btn btn-lg btn-success" disabled>
    </div>
</div>    
@endif 
</form>

 <br>



@stop


