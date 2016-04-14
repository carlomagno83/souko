@extends('layouts.scaffold')

@section('main')


<script type="text/javascript">
$(document).ready(function(){
  $("#storebutton").click(function(){

    if( $( "#usuario_id" ).val() == "" )    //valida campo 
    {
        alert("Escoja el usuario");
        return false;
    }
    if( $( "#local_id" ).val() == "" )    //valida campo 
    {
        alert("Escoja el local");
        return false;
    }
    if( $( "#datepicker1" ).val() == "" )    //valida campo 
    {
        alert("Ingrese fecha")
        return false
    }

    $(this).hide();
    $("#muestramsg").show();
    return true;});
 });
</script>


<script>
$(function() {
$( "#datepicker1" ).datepicker();
$( "#datepicker1" ).datepicker("setDate","0" );
$( "#datepicker1" ).datepicker('option', {dateFormat: 'yy/mm/dd'});
});  
</script>

{{--<div align="right">--}}
    {{--<a id="home" href=" {{ URL::to('/') }} "><img src='img/home.ico' border='0'></a>--}}
{{--</div>--}}
<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Traslado de mercadería a Pto de Venta desde Almacén</h3>
        Último registro: {{DB::table('documentos')->select('id')->where('tipomovimiento_id','2')->orderBy('id', 'desc')->pluck('id')}}, doc físico : {{DB::table('documentos')->select('numdocfisico')->where('tipomovimiento_id','2')->orderBy('id', 'desc')->pluck('numdocfisico')}}

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
            @if ($tempo->deslocal<>'ALM')
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
<div class="alert alert-success" >
<div class="row">
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" >Vendedor</span>
            {{Form::select('usuario_id', [''=>''] + DB::table('users')->where('rolusuario',"VENDE")->orderby('desusuario')->lists('desusuario','id'), Input::get('usuario_id'), array('id'=>'usuario_id', 'class'=>'form-control', 'required'=>'required'))}}
        </div>
    </div>

    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon">Local</span>
            {{Form::select('local_id',[''=>''] + DB::table('locals')->where('codlocal3','<>','ALM')->orderby('codlocal3')->lists('codlocal3','id'), Input::get('local_id'), array('id'=>'local_id', 'class'=>'form-control', 'required'=>'required'))}}
       </div>
    </div>
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="numdocfisico">Número de Documento Físico</span>
            <input type="text" name="numdocfisico" class="form-control" placeholder="" aria-describedby="basic-addon1">
        </div>
    </div>    
</div>  
<br>
    <div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="cantidaditem">Cantidad Items</span>
                <input type="text"  value="{{count($tempos)}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>
        <div class="col-lg-5">
        </div>    
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="fechadocumento">Fecha</span>
                <input type="text" id="datepicker1" name="fechadocumento" class="form-control" aria-describedby="basic-addon1" required>
            </div>
        </div>
    </div>    
    <div class="row">  
        <div class="col-lg-8">
        </div>        
        <div class="col-lg-3">
            Fecha Sugerida = Fecha Actual
        </div>
    </div>    
</div> 
</div> 
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


