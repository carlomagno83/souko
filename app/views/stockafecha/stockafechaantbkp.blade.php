@extends('layouts.scaffold')
@section('main')

<script>
$(function() {
$( "#datepicker1" ).datepicker();
$( "#datepicker1" ).datepicker("setDate","0" );
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

<style>
#cuadro table {
    width: 100%;
    display:block;
}
#cuadro thead {
    display: inline-block;
    width: 100%;
    height: 30px;
    font-weight: bolder;
    font-style: oblique;
}
#cuadro tbody {
    height: 450px;
    display: inline-block;
    width: 100%;
    overflow: auto;
}
</style>

<h3>Stock (Administrativo) para una fecha determinada</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </ul>
    </div>
@endif
<br>
<br>
<form method="POST" action="{{url('stockafecha-consultar')}}">
<div class="row">
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon">Consulta a la fecha:</span>
            <input type="text" id="datepicker1" name="fecini" class="form-control" Input::get('fecini') aria-describedby="basic-addon1" required>
        </div>
    </div><!-- /.col-lg-6 -->
    <div class="col-lg-2">
    </div>
    <div class="col-lg-2">
        <button type="submit" class="btn btn-info">Generar consulta</button>
    </div><!-- /.col-lg-6 -->     
</div>         
</form>
<br>
@if (count($mercaderias) > 0)
<br>
<br>

<h4>Consulta generada para el  {{Input::get('fecini')}} </h4>
<br>
<?php 
    $cantidad_locales = DB::table('locals')->count('id');
    $locals = DB::table('locals')->select('codlocal3')->orderby('id')->get();
    //$locals = DB::select("SELECT codlocal3 FROM locals");
    for ($i = 1; $i <= $cantidad_locales; $i++) 
    {
        $expresion[$i-1] = $locals[$i-1]->codlocal3 ;
    }   
    //dd($expresion[1]); 
    $maxmov=0;
    if (count($movimientos) > 0) $maxmov=count($movimientos); 
    $key=0;
    $key2=0;
    $fin=0;
    $comodin=0;
    $mayor=0;
?>

<table id="cuadro" class="table table-hover table-striped">
<thead> <td width="250px">GENERICO</td>
        @foreach ($locals as $local)
            <td width="55px">{{$local->codlocal3}}</td>
        @endforeach
</thead> 
<tbody>

@if (count($movimientos) > 0)
@while($key<=count($mercaderias)-1 )
    <tr>
    <?php 

        $gen1=$mercaderias[$key]->codmarca3."-".$mercaderias[$key]->codtipo8."-".$mercaderias[$key]->codrango6  ;

        if($key2<$maxmov)
        {
        $gen2=$movimientos[$key2]->codmarca3."-".$movimientos[$key2]->codtipo8."-".$movimientos[$key2]->codrango6 ;
        }
    ?> 

    <td>{{$key}}</td>
    <td>{{$key2}}</td>


    @if($gen1 < $gen2 and $fin==0)

        <td width="250px"> {{$mercaderias[$key]->codmarca3}}-{{$mercaderias[$key]->codtipo8}}-{{$mercaderias[$key]->codrango6}} </td> 
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
            <td width="55px">{{$mercaderias[$key]->$expresion[$i-1]}}</td>
        @endfor
        <?php $key++ ; ?>
    @endif
    @if($gen1 == $gen2 and $fin==0)
        <td width="250px"> {{$mercaderias[$key]->codmarca3}}-{{$mercaderias[$key]->codtipo8}}-{{$mercaderias[$key]->codrango6}} </td> 
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
            <td width="55px">{{$mercaderias[$key]->$expresion[$i-1] + $movimientos[$key2]->$expresion[$i-1]}}</td>
        @endfor
        <?php 
            $key++ ;
            if($key2<$maxmov and $fin==0) 
                {
                    $key2=$key2+1; 
                    if($maxmov==$key2) 
                        {
                            $fin=1;
                        }
                  } 
        ?>
    @endif
    @if($gen1 > $gen2 and $fin==1)
        <td width="250px"> {{$mercaderias[$key]->codmarca3}}-{{$mercaderias[$key]->codtipo8}}-{{$mercaderias[$key]->codrango6}} </td> 
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
            <td width="55px">{{$mercaderias[$key]->$expresion[$i-1]}}</td>
        @endfor
        <?php $key++ ; ?>
    @endif 

    @if($gen1 > $gen2 and $fin==0)
       <td width="250px"> {{$movimientos[$key2]->codmarca3}}-{{$movimientos[$key2]->codtipo8}}-{{$movimientos[$key2]->codrango6}} </td>
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
            <td width="55px">{{$movimientos[$key2]->$expresion[$i-1]}}</td>
        @endfor
        <?php
            if($key2<$maxmov and $fin==0) 
                {
                    $key2=$key2+1;
                    if($maxmov==$key2) 
                        {
                            $fin=1;
                        }
                } 
            $gen2=$movimientos[$key2]->codmarca3."-".$movimientos[$key2]->codtipo8."-".$movimientos[$key2]->codrango6 ;    
        ?>
        
        @while ($gen1 > $gen2 and $fin==0)
            <tr>
            <td width="250px"> {{$movimientos[$key2]->codmarca3}}-{{$movimientos[$key2]->codtipo8}}-{{$movimientos[$key2]->codrango6}} </td>
            @for ($i = 1; $i <= $cantidad_locales; $i++) 
                <td width="55px">{{$movimientos[$key2]->$expresion[$i-1]}}</td>
            @endfor
            </tr>
            <?php
                if($key2<$maxmov and $fin==0) 
                    {
                        $key2=$key2+1;
                        if($maxmov==$key2) 
                            {
                                $fin=1;
                            }
                    } 
                $gen2=$movimientos[$key2]->codmarca3."-".$movimientos[$key2]->codtipo8."-".$movimientos[$key2]->codrango6 ;
            ?>
            
        @endwhile

    @endif
    </tr>
@endwhile
@endif



@if (count($movimientos) == 0)
@foreach( $mercaderias as $key=>$value)
    <tr>
        <td width="250px"> {{$value->codmarca3}}-{{$value->codtipo8}}-{{$value->codrango6}} </td> 
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
            <td width="55px">{{$value->$expresion[$i-1]}}</td>
        @endfor
    </tr>
@endforeach
@endif
</tbody>
</table>


<form method="POST" action="{{url('stockafecha-descargar')}}">
<input type="text" style="visibility:hidden" id="fecha" name="fecha" value={{Input::get('fecini')}} aria-describedby="basic-addon1" readonly="" tabindex="-1">
<div class="row">
    <div class="col-lg-4">
    </div><!-- /.col-lg-6 -->
    <div class="col-lg-2">
    </div>
    <div class="col-lg-2">
        <button type="submit" class="btn btn-info">Descargar Archivo Excel del {{Input::get('fecini')}} </button>
    </div><!-- /.col-lg-6 -->     
</div>         
</form>

@endif
@stop
