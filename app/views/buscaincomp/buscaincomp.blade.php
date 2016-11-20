@extends('layouts.scaffold')
@section('main')

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
    height: 180px;
    display: inline-block;
    width: 100%;
    overflow: auto;
}

p {
    font-size: 200%;
    animation-duration: 1200ms;
    animation-name: blink;
    animation-iteration-count: infinite;
    animation-direction: alternate;
    -webkit-animation:blink 1200ms infinite; /* Safari and Chrome */
}
@keyframes blink {
    from {
        color:red;
    }
    to {
        color:white;
    }
}
@-webkit-keyframes blink {
    from {
        color:red;
    }
    to {
        color:white;
    }
}

</style>


<h3>

Herramienta Buscador de Inconsistencias</th>   

</h3>                      
(Incluye mercaderías en estado Inactivo) <br>
           
<br>


<?php 
    $cantidad_locales = DB::table('locals')->count('id');
    $locals = DB::table('locals')->select('codlocal3')->orderby('id')->get();
    for ($i = 1; $i <= $cantidad_locales; $i++) 
    {
        $expresion[$i-1] = $locals[$i-1]->codlocal3 ;
    }  
    $b=1; 
    $totalmercaB=count($bmercaderias);
    $ok=0;
    $vacio=0;
    $encuentra=0;
?>


<table id ="cuadro" class="table table-hover table-striped">
<thead> <td width="250px">GENERICO</td>
        @foreach ($locals as $local)
            <td width="55px">{{$local->codlocal3}}</td>
        @endforeach
</thead> 
<tbody>
@foreach( $amercaderias as $key=>$value)
    @for (; $b <=$totalmercaB ; )  <!--   $totalmercaB  -->
    <?php 
    $cod31a=$value->codmarca3."-".$value->codtipo8."-".$value->codrango6;
    $cod31b=$bmercaderias[$b-1]->codmarca3."-".$bmercaderias[$b-1]->codtipo8."-".$bmercaderias[$b-1]->codrango6;
    ?>

     
        @if($cod31a==$cod31b)
            @for ($i = 1; $i <= $cantidad_locales-1; $i++) 
                @if($value->$expresion[$i-1]==$bmercaderias[$b-1]->$expresion[$i-1])
                    <?php $ok=$ok+0;?>
                @else
                    <?php $ok=$ok+1; ?>
                @endif    
            @endfor
            @if($ok>0) 
                <tr> 
                <td width="250px"> {{$value->codmarca3}}-{{$value->codtipo8}}-{{$value->codrango6}} </td>
                @for ($i = 1; $i <= $cantidad_locales; $i++) 
                    <td width="55px">{{$value->$expresion[$i-1]}}</td>
                @endfor
                </tr>
                <tr> 
                <td width="250px"> {{$value->codmarca3}}-{{$value->codtipo8}}-{{$value->codrango6}}.(ACUM) </td>
                @for ($i = 1; $i <= $cantidad_locales; $i++) 
                    <td width="55px">{{$bmercaderias[$b-1]->$expresion[$i-1]}}</td>
                @endfor
                </tr>
                <?php  $encuentra=$encuentra+1; ?>
            @endif
            <?php $ok=0; ?>
            <?php $b=$b+1 ; break 1;?>  
        @else
            @for ($i = 1; $i <= $cantidad_locales-1; $i++) 
                @if($bmercaderias[$b-1]->$expresion[$i-1]==0)
                    <?php $vacio=$vacio+0;?>
                @else
                    <?php $vacio=$vacio+1; ?>
                @endif    
            @endfor  
            @if($vacio>0) 
                <tr> 
                <td width="250px"> {{$cod31b}} </td>
                @for ($i = 1; $i <= $cantidad_locales; $i++) 
                    <td width="55px">{{$bmercaderias[$b-1]->$expresion[$i-1]}}</td>
                @endfor
                </tr>
                <?php $vacio=0; $encuentra=$encuentra+1; ?> 
                <?php $b=$b+1 ; ?> 
            @endif                  
        @endif 
    
    <?php $b=$b+1 ; ?> 
    @endfor
@endforeach
</tbody>
</table>

@if( $encuentra>0)
    <p>HOUSTON, TENEMOS UN PROBLEMA!!!!</p>
@else
    <h2>Búsqueda completa, No hay errores</h2>
@endif
@stop
