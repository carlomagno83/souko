@extends('layouts.scaffold')

@section('main')

<script type="text/javascript">
$(document).ready(function(){
  $("#storebutton").click(function(){

    if( $( "#usuario_id" ).val() == "" )    //valida campo 
    {
        alert("Ingrese Usuario")
        return false
    }
    if( $( "#local_id" ).val() == "" )    //valida campo 
    {
        alert("Ingrese local")
        return false
    }   
    if( $( "#datepicker1" ).val() =="" )    //valida campo 
    {
        alert("Ingrese fecha")
        return false
    }

    $(this).hide();
    $("#muestramsg").show();
    return true;});



 });
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
$(function() {
$( "#datepicker1" ).datepicker();
$( "#datepicker1" ).datepicker("setDate","0" );
$( "#datepicker1" ).datepicker('option', {dateFormat: 'yy/mm/dd'});
});  
</script>


<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Devolución de mercadería de un Punto de Venta a Almacén</h3>
        Último registro: {{DB::table('documentos')->select('id')->where('tipomovimiento_id','6')->orderBy('id', 'desc')->pluck('id')}}, doc físico : {{DB::table('documentos')->select('numdocfisico')->where('tipomovimiento_id','6')->orderBy('id', 'desc')->pluck('numdocfisico')}}
        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

<form method="POST" id="validadorjs" action="{{url('devolucionptoventa-agregareg')}}">
<br>
<div class="row">
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="mercaderia_id">Mercadería</span>
            <input type="text" name="mercaderia_id" class="form-control" placeholder="Uso de pistola" aria-describedby="basic-addon1" autofocus>
       </div>
    </div><!-- /.col-lg-6 -->  
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="estado">Motivo devolución</span>
            {{Form::select('estado',[''=>'', 'ACT'=>'ACTIVO', 'INA'=>'INACTIVO', 'BAJ'=>'BAJA'] ,null,array('class'=>'form-control', 'required'=>'required'))}} <!-- cambio para escoger motivo -->
       </div>
    </div><!-- /.col-lg-6 -->
    <input type="submit" value="Agrega Mercaderia" class=" btn btn-success"> 
</div><!-- /.row -->
<br>
<br>
</form>

<form method="POST" id="validadorjs" action="{{url('devolucionptoventa-store')}}">
<table class="table table-striped">
    <thead>
        <tr>
            <th width="10%">Mercadería id</th>
            <th width="10%">Producto id</th>
            <th>Descripción cod31</th>
            <th width="20%">Local Actual</th>
            <th width="8%">Estado Actual</th>
            <th width="8%">Nuevo Estado</th>
        </tr>    
    </thead>

@if (count($devuelves)>0)
<?php $deslocal=DB::table('devuelves')->select('deslocal')->pluck('deslocal');
$foul = 0; ?>
        @foreach ($devuelves as $devuelve)
        <tr>
            <td width="10%"><input type="text" name="mercaderia_id[]" id="mercaderia_id[]" value="{{$devuelve->mercaderia_id}}" class="form-control" readonly tabindex="-1"></td>
            <td width="10%"><input type="text" name="producto_id[]" id="producto_id[]" value="{{$devuelve->producto_id}}" readonly class="form-control" tabindex="-1"></td>
            <td><input type="text"  value="{{$devuelve->codproducto31}}" readonly class="form-control" tabindex="-1"></td>
            @if($devuelve->deslocal<>'ALM' )
                @if (count($devuelves)>1)
                    @if($devuelve->deslocal == $deslocal)
                        <td width="20%"><input type="text"  value="{{$devuelve->deslocal}}" readonly class="form-control" tabindex="-1"></td>
                    @else
                        <td width="20%" class="danger"><input type="text"  value="{{$devuelve->deslocal}}" readonly class="form-control" tabindex="-1"></td>
                        <?php $foul = $foul + 1 ?>
                    @endif
                @else
                    <td width="20%"><input type="text"  value="{{$devuelve->deslocal}}" readonly class="form-control" tabindex="-1"></td>
                @endif
            @else
                <td width="20%" class="danger"><input type="text"  value="{{$devuelve->deslocal}}" readonly class="form-control" tabindex="-1"></td>
                <?php $foul = $foul + 1 ?>
            @endif    
            @if ($devuelve->estado=='ACT')
                <td width="10%"><input type="text"  value="{{$devuelve->estado}}" readonly class="form-control" tabindex="-1"></td>
            @else
                <td width="10%" class="danger"><input type="text"  value="{{$devuelve->estado}}" readonly class="form-control" tabindex="-1"></td>
            @endif              

            @if ($devuelve->nuevoestado=='ACT')
                <td width="8%"><input type="text" name="nuevoestado[]" value="{{$devuelve->nuevoestado}}" readonly class="form-control" tabindex="-1"></td>
            @else
                <td width="8%" class="danger"><input type="text" name="nuevoestado[]" value="{{$devuelve->nuevoestado}}" readonly class="form-control" tabindex="-1"></td>
            @endif              

            <td width="5%"><a id="link_delete" href=" {{ URL::to('devolucionptoventa/delete/'.$devuelve->mercaderia_id) }} "><img width="30px" src="{{asset('img/eliminar.png')}}"></a></td>
            <td width="5%"><a href="{{URL::to('consultamercaderia/'.$devuelve->mercaderia_id)}}" target="_blank"><img width="30px" src="{{asset('img/lupa.png')}}"></a></td>
        </tr>
        @endforeach
    

</table>

<div class="alert alert-success" >
    <div class="row">
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="marca_id">Vendedor</span>
                {{Form::select('usuario_id', [''=>''] + DB::table('users')->where('rolusuario',"VENDE")->where('estado',"ACT")->orderby('desusuario')->lists('desusuario','id'),null,array('id'=>'usuario_id', 'class'=>'form-control', 'required'=>'required'))}}
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="localini">Local que devuelve (verif)</span>
                {{Form::select('localini',[''=>''] + DB::table('locals')->where('codlocal3','<>','ALM')->orderby('codlocal3')->lists('codlocal3','id'),null,array('id'=>'local_id', 'class'=>'form-control', 'required'=>'required'))}}
           </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="numdocfisico">Número de Documento Físico</span>
                <input type="text" name="numdocfisico" class="form-control" placeholder="" aria-describedby="basic-addon1">
            </div>
        </div>           
    </div><!-- /.row -->
    <br>
    <div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="fechadocumento">Fecha</span>
                <input type="text" id="datepicker1" name="fechadocumento" class="form-control" aria-describedby="basic-addon1">
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon">Cantidad Items</span>
                <input type="text" value={{count($devuelves)}} class="form-control" aria-describedby="basic-addon1" readonly tabindex="-1">
            </div>
        </div><!-- /.col-lg-6 -->        
    </div><!-- /.row -->
    <div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                Fecha Sugerida = Fecha Actual
            </div>
        </div>           
    </div><!-- /.row -->    
</div>    
@if ($foul == 0)
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
@endif    
<br>
<br>
<br>
<br>
</form>
@endif

@stop


