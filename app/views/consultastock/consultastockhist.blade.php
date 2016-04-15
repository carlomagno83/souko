@extends('layouts.scaffold')
@section('main')

<script>
$(function() {
$( "#datepicker1" ).datepicker();
$( "#datepicker1" ).datepicker('option', {dateFormat: 'yy/mm/dd'});
});  

</script>


<script type="text/javascript">
$(document).ready(function(){
  $("#storebutton").click(function(){

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



<h3>Consulta de stock histórico</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </ul>
    </div>
@endif

<form method="POST" action="{{url('consulta-stock-historico')}}">
<div class="row">


        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon">Fecha</span>
                <input type="text" id="datepicker1" name="fechadocumento" class="form-control" Input::get('fechadocumento') aria-describedby="basic-addon1" required>
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="local_id">Local</span>
<!--                {{Form::select('local_id',[0=>''] + DB::table('locals')->orderby('id')->where('id', '<>', 1)->lists('codlocal3','id'), Input::get('local_id'),array('class'=>'form-control', 'required'=>'required'))}} -->
                    {{Form::select('local_id',[0=>''] + DB::table('locals')->orderby('id')->lists('codlocal3','id'), Input::get('local_id'),array('class'=>'form-control', 'required'=>'required'))}}
           </div>
        </div><!-- /.col-lg-6 -->


        <br>
</div>  
<br>
<div class="row">
    <div class="col-lg-10">
    </div>
    <div class="col-lg-2">
                <button type="submit" class="btn btn-info">Consultar</button>
    </div><!-- /.col-lg-6 -->     
</div> 
</form>

<br>



@if (count($mercaderias) > 0)
<div class="jumbotron">

<?php 
    $local_id = Input::get('local_id');
    //dd($local_id);
    /*$total = DB::select("SELECT COUNT(id) AS tot
                        FROM mercaderias
                        WHERE local_id=".$local_id." and (estado='ACT' OR estado='INA')");*/
    $total = DB::table('mercaderias')->where('local_id', '=', Input::get('local_id') )->whereIn('estado', array('ACT', 'INA'))->count('id');                    
    //dd($total);

?>
@if(Input::get('local_id')==1)
    <table class="table table-hover table-striped">
    <thead>
        <tr>
            <th width="20%">Fecha</th>
            <th>Ingreso a Almacén</th>
            <th>Devoluciones de Pto</th>
            <th>Traslado a pto</th>
            <th>Salida por devolución</th>
            <th>TOTAL</th>
        </tr>
    </thead> 
    <tbody>
    @foreach( $mercaderias as $mercaderia)
        <tr> 
            <td> {{$mercaderia->fechadocumento}} </td> 
            <td> {{$mercaderia->cta_alm_ing}} </td> 
            <td> {{$mercaderia->cta_pto_ing}} </td>  
            <td><font color="red"> {{$mercaderia->cta_pto_sal}} </font></td> 
            <td><font color="red"> {{$mercaderia->cta_dev_sal}} </font></td> 

            <td><b> {{$total}} </b></td>
            <?php 
                $total = $total - $mercaderia->cta_alm_ing - $mercaderia->cta_pto_ing + $mercaderia->cta_pto_sal + $mercaderia->cta_dev_sal

            ?>
        </tr>
    @endforeach
    </tbody>
    </table>


@else
    <table class="table table-hover table-striped">
    <thead>
        <tr>
            <th width="20%">Fecha</th>
            <th>Ingreso de Almacén</th>
            <th>Ingreso por traslado</th>
            <th>Salida por venta</th>
            <th>Salida por traslado</th>
            <th>Salida por devolución</th>
            <th>TOTAL</th>
        </tr>
    </thead> 
    <tbody>
    @foreach( $mercaderias as $mercaderia)
        <tr> 
            <td> {{$mercaderia->fechadocumento}} </td> 
            <td> {{$mercaderia->cta_alm_ing}} </td> 
            <td> {{$mercaderia->cta_pto_ing}} </td> 
            <td><font color="red"> {{$mercaderia->cta_vta_sal}} </font></td> 
            <td><font color="red"> {{$mercaderia->cta_pto_sal}} </font></td> 
            <td><font color="red"> {{$mercaderia->cta_dev_sal}} </font></td> 

            <td><b> {{$total}} </b></td>
            <?php 
                $total = $total - $mercaderia->cta_alm_ing - $mercaderia->cta_pto_ing + $mercaderia->cta_vta_sal + $mercaderia->cta_pto_sal + $mercaderia->cta_dev_sal

            ?>
        </tr>
    @endforeach
    </tbody>
    </table>
@endif    
@endif 
</div>
</div>

@stop
