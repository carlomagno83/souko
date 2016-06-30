@extends('layouts.scaffold')
@section('main')

<script>
$(function() {
$( "#datepicker1" ).datepicker();
$( "#datepicker1" ).datepicker("setDate","-7" );
$( "#datepicker1" ).datepicker('option', {dateFormat: 'yy/mm/dd'});
});  

</script>


<script type="text/javascript">
$(document).ready(function(){
  $("#consultabutton").click(function(){

    if( $( "#datepicker1" ).val() =="" )    //valida campo 
    {
        alert("Ingrese fecha")
        return false
    }
    if( $( "#tipomovimiento_id" ).val() == 0 )    //valida campo 
    {
        alert("Ingrese el tipo de movimiento")
        return false
    }

    $(this).hide();
    $("#muestramsg").show();
    return true;});
 });
</script>



<h3>Consulta de Documentos</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </ul>
    </div>
@endif

<form method="POST" action="{{url('consulta-docs')}}">
<div class="row">


        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon">Buscar desde (Sug 7 días antes)</span>
                <input type="text" id="datepicker1" name="fechadocumento" class="form-control" Input::get('fechadocumento') aria-describedby="basic-addon1" required>
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon">Tipo Documento</span>
                {{Form::select('tipomovimiento_id',[0=>''] + DB::table('tipomovimientos')->orderby('id')->where('destipomovimiento', '<>', '')->lists('destipomovimiento','id'), Input::get('tipomovimiento_id'),array('class'=>'form-control',  'id'=>'tipomovimiento_id', 'required'=>'required'))}}
           </div>
        </div><!-- /.col-lg-6 -->


        <br>
</div>  
<br>
<div class="row">
    <div class="col-lg-10">
    </div>
    <div class="col-lg-2">
                <button type="submit" id="consultabutton" class="btn btn-info">Consultar</button>
    </div><!-- /.col-lg-6 -->     
</div> 
</form>

<br>



@if (count($documentos) > 0)

<div class="jumbotron">

<table class="table table-hover table-striped">
@if (Input::get('tipomovimiento_id') == 1)
<thead>
    <tr>
        <th># Doc</th>
        <th># Físico</th>
        <th>Fecha Doc</th>
        <th>Proveedor</th>
        <th>Creado por</th>
        <th>Items</th>
        <th>Total Compra</th>
    </tr>
</thead> 
<tbody>
@foreach( $documentos as $documento)
    <tr> 
        <td> {{$documento->id}} </td> 
        <td> {{$documento->numdocfisico}} </td> 
        <td> {{$documento->fechadocumento}} </td> 
        <td> {{$documento->codprovider3}} </td> 
        <td> {{$documento->desusuario}} </td> 
        <td> {{$documento->cantidad}} </td> 
        <td><b> {{$documento->totalcompra}} </b></td>
        <td><a id="link_detalle" href=" {{ URL::to('consultadocs/detalle1/'.$documento->id) }} "><font color="0000FF">Ver Detalle</font></a>  </td>

    </tr>
@endforeach
@endif

@if (Input::get('tipomovimiento_id') == 2)
<thead>
    <tr>
        <th># Doc</th>
        <th># Físico</th>
        <th>Fecha Doc</th>
        <th>Creado por</th>
        <th>Salida a Pto</th>
        <th>Items</th>
    </tr>
</thead> 
<tbody>
@foreach( $documentos as $documento)
    <tr> 
        <td> {{$documento->id}} </td> 
        <td> {{$documento->numdocfisico}} </td> 
        <td> {{$documento->fechadocumento}} </td> 
        <td> {{$documento->desusuario}} </td> 
        <td> {{$documento->localfin}} </font></td> 
        <td> {{$documento->cantidad}} </font></td> 
        <td><a id="link_detalle" href=" {{ URL::to('consultadocs/detalle2/'.$documento->id) }} "><font color="0000FF">Ver Detalle</font></a>  </td>
    </tr>
@endforeach
@endif

@if (Input::get('tipomovimiento_id') == 3)
<thead>
    <tr>
        <th># Doc</th>
        <th>Fecha Doc</th>
        <th>Pto Venta</th>
        <th>Vendedor</th>
        <th>Creado por</th>
        <th>Items</th>
        <th>Total Ventas</th>
    </tr>
</thead> 
<tbody>
@foreach( $documentos as $documento)
    <tr> 
        <td> {{$documento->id}} </td> 
        <td> {{$documento->fechadocumento}} </td> 
        <td> {{$documento->localfin}} </font></td> 
        <td> {{$documento->vende}} </font></td> 
        <td> {{$documento->desusuario}} </font></td> 
        <td> {{$documento->cantidad}} </font></td> 
        <td><b> {{$documento->totalventa + $documento->devolucion }} </b></td>
        <td><a id="link_detalle" href=" {{ URL::to('consultadocs/detalle3/'.$documento->id) }} "><font color="0000FF">Ver Detalle</font></a>  </td>

    </tr>
@endforeach
@endif

@if (Input::get('tipomovimiento_id') == 4)
<thead>
    <tr>
        <th># Doc</th>
        <th># Físico</th>
        <th>Fecha Doc</th>
        <th>Pto Inicial</th>
        <th>Pto Final</th>
        <th>Creado por</th>
        <th>Items</th>
    </tr>
</thead> 
<tbody>
@foreach( $documentos as $documento)
    <tr> 
        <td> {{$documento->id}} </td> 
        <td> {{$documento->numdocfisico}} </td> 
        <td> {{$documento->fechadocumento}} </td> 
        <td> {{$documento->localini}} </font></td> 
        <td> {{$documento->localfin}} </font></td> 
        <td> {{$documento->desusuario}} </font></td> 
        <td> {{$documento->cantidad}} </font></td> 
        <td><a id="link_detalle" href=" {{ URL::to('consultadocs/detalle4/'.$documento->id) }} "><font color="0000FF">Ver Detalle</font></a>  </td>

    </tr>
@endforeach
@endif

@if (Input::get('tipomovimiento_id') == 6)
<thead>
    <tr>
        <th># Doc</th>
        <th># Físico</th>
        <th>Fecha Doc</th>
        <th>Devolución de</th>
        <th>Creado por</th>
        <th>Items</th>
    </tr>
</thead> 
<tbody>
@foreach( $documentos as $documento)
    <tr> 
        <td> {{$documento->id}} </td> 
        <td> {{$documento->numdocfisico}} </td> 
        <td> {{$documento->fechadocumento}} </td> 
        <td> {{$documento->localini}} </font></td> 
        <td> {{$documento->desusuario}} </font></td> 
        <td> {{$documento->cantidad}} </font></td> 
        <td><a id="link_detalle" href=" {{ URL::to('consultadocs/detalle6/'.$documento->id) }} "><font color="0000FF">Ver Detalle</font></a>  </td>

    </tr>
@endforeach
@endif

@if (Input::get('tipomovimiento_id') == 7)
<thead>
    <tr>
        <th># Doc</th>
        <th># Físico</th>
        <td>Fecha Creación</td>
        <th>Fecha Liq</th>
        <th>Estado</th>>
        <th>Devolución A</th>
        <th>Creado por</th>
        <th>Items</th>
        <th>Total Compra</th>
    </tr>
</thead> 
<tbody>
@foreach( $documentos as $documento)
    <tr> 
        <td> {{$documento->id}} </td> 
        <td> {{$documento->numdocfisico}} </td>
        @if($documento->flagestado =='BAJ')
            <td>{{date('Y-m-d', strtotime($documento->docucrea))}}</td>
        @else
            <td> {{$documento->fechadocumento}} </td>
        @endif 
        @if($documento->flagestado =='BAJ')
            <td> {{$documento->fechadocumento}} </td>
        @else
            <td>0000-00-00</td>
        @endif         
        <td> {{$documento->flagestado}} </td>
        <td> {{$documento->codprovider3}} </font></td> 
        <td> {{$documento->desusuario}} </font></td> 
        <td> {{$documento->cantidad}} </font></td> 
        <td> {{$documento->totalcompra}} </font></td> 
        <td><a id="link_detalle" href=" {{ URL::to('consultadocs/detalle7/'.$documento->id) }} "><font color="0000FF">Ver Detalle</font></a>  </td>

    </tr>
@endforeach
@endif





</tbody>
</table>
@endif 
</div>
</div>

@stop
