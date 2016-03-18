@extends('layouts.scaffold')
@section('main')

<h3>
<table  style="width:100%">
<td width="70%"> Reporte de Stock actual</td>                           
<td width="30%" align="right"> <a style="padding-top: 8px;" href="{{URL::to('descargaexcel')}}"><img width="60px" src="{{asset('img/downloadXL.gif')}}"></a></td>


</table>

</h3>

<div class="jumbotron">

<?php 
    $cantidad_locales = DB::table('locals')->count('id');
    $locals = DB::table('locals')->select('codlocal3')->get();
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

<table class="table table-hover table-striped">
<thead> <th>CODIGO</th>
        @foreach ($locals as $local)
            <th>{{$local->codlocal3}}</th>
        @endforeach
</thead> 
<tbody>
@foreach( $mercaderias as $key=>$value)
    <tr> 
        <td> {{$value->codproducto31}} </td> 
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
                <td>{{$value->$expresion[$i-1]}}</td>

        @endfor
    </tr>
@endforeach
</tbody>
@foreach( $totales as $key=>$value)
    <tr> 
        <td> </td> 
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
                <td><big><b>{{$value->$expresion[$i-1]}}</b></big></td>
        @endfor
    </tr>

@endforeach
</table>
</div>

@stop
