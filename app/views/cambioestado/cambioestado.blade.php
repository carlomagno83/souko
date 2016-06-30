@extends('layouts.scaffold')

@section('main')


<script type="text/javascript">
$(document).ready(function(){
  $("#storebutton").click(function(){

    if( $( "#estado" ).val() == "" )    //valida campo 
    {
        alert("Escoja el estado");
        return false;
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
        <h3>Cambio de estado por bloques</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>


<form method="POST" id="validadorjs" action="{{url('cambioestado-agregareg')}}">

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

    <div class="col-lg-2"> 
        @if (count($cambios)>0)
        Total items: {{count($cambios)}} 
        @endif   
    </div>   
    
</div><!-- /.row -->

<br>
</form>  

<form method="POST" id="validadorjs" action="{{url('cambioestado-store')}}">
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

@if (count($cambios)>0)
        @foreach ($cambios as $cambio)
        <tr>
            <td width="10%"><input type="text" name="mercaderia_id[]" id="mercaderia_id[]" value="{{$cambio->mercaderia_id}}" class="form-control" readonly tabindex="-1"></td>
            <td width="10%"><input type="text" name="producto_id[]" id="producto_id[]" value="{{$cambio->producto_id}}" readonly class="form-control" tabindex="-1"></td>
            <td><input type="text"  value="{{$cambio->codproducto31}}" readonly class="form-control" tabindex="-1"></td>
            @if ($cambio->deslocal<>'ALM')
                <td class="danger"><input type="text"  value="{{$cambio->deslocal}}" readonly class="form-control" tabindex="-1"></td>
            @else
                <td><input type="text"  value="{{$cambio->deslocal}}" readonly class="form-control" tabindex="-1"></td>
            @endif
                
            <td width="10%"><input type="text" value="{{$cambio->estado}}" readonly class="form-control" tabindex="-1"></td>
            
            <td><a id="link_delete" href=" {{ URL::to('cambioestado/delete/'.$cambio->mercaderia_id) }} ">Eliminar</a>  </td>
        </tr>
        @endforeach
    
</table>
<div class="alert alert-success" >


<div class="row">
    @if(Auth::user()->rolusuario=='SUPER')
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" >Nuevo estado</span>
            {{Form::select('estado', [''=>'', 'ACT'=>'ACT', 'INA'=>'INA', 'BAJ'=>'BAJ', 'DEV'=>'DEV', 'VEN'=>'VEN'] , Input::get('usuario_id'), array('id'=>'estado', 'class'=>'form-control', 'required'=>'required'))}}
        </div>
    </div>
    @else
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" >Nuevo estado</span>
            {{Form::select('estado', [''=>'', 'ACT'=>'ACT', 'INA'=>'INA'] , Input::get('usuario_id'), array('id'=>'estado', 'class'=>'form-control', 'required'=>'required'))}}
        </div>
    </div>    
    @endif
 <div class="row">
    <div class="col-lg-4">
        <input id="storebutton" type="submit" value="Cambiar estado" class="btn btn-lg btn-primary">
    </div>
</div>
</div> 
</div> 

  
@endif 
</form>

 <br>



@stop


