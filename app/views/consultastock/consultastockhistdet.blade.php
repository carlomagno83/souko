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



<h3>Consulta de stock histórico con Filtros</h3>
(Incluye mercaderías en estado Inactivo)
<br>
<br>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </ul>
    </div>
@endif

<form method="POST" action="{{url('consulta-stock-historico-det')}}">
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
                {{Form::select('local_id',[0=>''] + DB::table('locals')->orderby('id')->lists('codlocal3','id'), Input::get('local_id'),array('class'=>'form-control', 'required'=>'required'))}}
           </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
        </div>
</div>  
<br>
<div class="row">

        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="marca_id">Marca</span>
                {{Form::select('marca_id',[0=>''] + DB::table('marcas')->orderby('desmarca')->lists('desmarca','id'), Input::get('marca_id'),array('class'=>'form-control'))}}
           </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="tipo_id">Tipo</span>
                {{Form::select('tipo_id', [0=>''] + DB::table('tipos')->orderby('destipo')->lists('destipo','id'), Input::get('tipo_id'),array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="rango_id">Rango</span>
                {{Form::select('rango_id',[0=>''] + DB::table('rangos')->orderby('desrango')->lists('desrango','id'), Input::get('rango_id'),array('class'=>'form-control'))}}
           </div>
        </div><!-- /.col-lg-6 -->

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

<?php 
    $local_id = Input::get('local_id');
    $tmptot = 0;
    $tmp1 = Input::get('marca_id');
    $tmp2 = Input::get('tipo_id');
    $tmp3 = Input::get('rango_id');
    $tmptot = $tmp1 + $tmp2 + $tmp3 ; 
    if($local_id==1)   //si es almacen
    {
        if($tmptot==0)
        {
            //si es alm y sin filtro
            $total = DB::table('mercaderias')->where('local_id', '=', 1 )->whereIn('estado', array('ACT', 'INA'))->count('id'); 
        }   
        else
        {
            $total = Mercaderia::where('mercaderias.id','>',0);
            if(Input::get('marca_id')>0)
                $total = $total->where('marca_id',Input::get('marca_id'));
            if(Input::get('tipo_id')>0)
                $total = $total->where('tipo_id',Input::get('tipo_id'));
            if(Input::get('rango_id')>0)
                $total = $total->where('rango_id',Input::get('rango_id'));

            $total = $total->join('productos', 'mercaderias.producto_id','=', 'productos.id')
                            ->where('mercaderias.local_id', '=', 1 )
                            ->whereIn('estado', array('ACT', 'INA'))
                            ->count('mercaderias.id'); 
            //dd($total);
        } 
    }
    else
    {
        if($tmptot==0)
        {
            //si es diferente de alm y sin filtro
            $total = DB::table('mercaderias')->where('local_id', '=', Input::get('local_id') )->whereIn('estado', array('ACT', 'INA'))->count('id'); 
        }   
        else
        {
            $total = Mercaderia::where('mercaderias.id','>',0);
            if(Input::get('marca_id')>0)
                $total = $total->where('marca_id',Input::get('marca_id'));
            if(Input::get('tipo_id')>0)
                $total = $total->where('tipo_id',Input::get('tipo_id'));
            if(Input::get('rango_id')>0)
                $total = $total->where('rango_id',Input::get('rango_id'));

            $total = $total->join('productos', 'mercaderias.producto_id','=', 'productos.id')
                            ->where('mercaderias.local_id', '=', Input::get('local_id') )
                            ->whereIn('estado', array('ACT', 'INA'))
                            ->count('mercaderias.id'); 
            //dd($total);                
        } 
    }    

    
    
?>
@if (count($mercaderias) > 0)
<div class="jumbotron">

@if(Input::get('local_id')==1)
    <table class="table table-hover table-striped">
    <thead>
        <tr>
            <th width="20%">Fecha</th>
            <th>ING PROVEED A ALMACEN</th>
            <th>DEV PTO A ALMACEN</th>
            <th>TRASLADO ALMACEN A PTO</th>
            <th>Salida por DEVOLC A PROVEED</th>
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
            <th>TRASLADO ALMACEN A PTO</th>
            <th>Ingreso por TRASLADO PTO-PTO</th>
            <th>Salida por VENTA</th>
            <th>Salida por TRASLADO PTO-PTO</th>
            <th>Salida por DEV PTO A ALMACEN</th>
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
