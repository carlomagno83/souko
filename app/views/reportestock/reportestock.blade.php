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
    height: 450px;
    display: inline-block;
    width: 100%;
    overflow: auto;
}

#pie table {
    width: 100%;
    display:block;
}
#pie thead {
    display: inline-block;
    width: 100%;
    height: 30px;
    font-weight: bolder;
    font-style: oblique;
}
#pie tbody {
    display: inline-block;
    width: 100%;
}
</style>

<h3>

<table>
<td width="25%"> Reporte de Stock actual</td>    
<td width="50%"></td>                       
<td width="25%" align="right"> <a style="padding-top: 8px;" href="{{URL::to('descargaexcel')}}"><img width="60px" src="{{asset('img/downloadXL.gif')}}"></a></td>
</table>

</h3>


<?php 
    $cantidad_locales = DB::table('locals')->count('id');
    $locals = DB::table('locals')->select('codlocal3')->orderby('id')->get();
    //$locals = DB::select("SELECT codlocal3 FROM locals");
    //$expresion = "<td> ";
    //dd($locals[0]->codlocal3);
    for ($i = 1; $i <= $cantidad_locales; $i++) 
    {

        //$expresion[$i-1] = '<td>$value->'.  $locals[$i-1]->codlocal3 .'</td>';
        //$expresion[$i-1] = '$value->'.  $locals[$i-1]->codlocal3 ;
        $expresion[$i-1] = $locals[$i-1]->codlocal3 ;
    }   
    //dd($expresion[1]); 
?>

<table id="cuadro" class="table table-hover table-striped">
<thead> <td width="280px">CODIGO</td>
        @foreach ($locals as $local)
            <td width="55px">{{$local->codlocal3}}</td>
        @endforeach
</thead> 
<tbody>
@foreach( $mercaderias as $key=>$value)
    <tr> 
        <td width="280px"> {{$value->codproducto31}} </td> 
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
                <td width="55px">{{$value->$expresion[$i-1]}}</td>

        @endfor
    </tr>
@endforeach

</tbody>
</table>
<table id="pie" class="table table-hover table-striped">
@foreach( $totales as $key=>$value)
    <tr> 
        <td width="280px"> </td> 
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
                <td width="55px"><big><b>{{$value->$expresion[$i-1]}}</b></big></td>
        @endfor
    </tr>

@endforeach
</table>



@stop
