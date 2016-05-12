@extends('layouts.scaffold')
@section('main')

<style>
table {
    width: 100%;
    display:block;
}
thead {
    display: inline-block;
    width: 100%;
    height: 30px;
    font-weight: bolder;
    font-style: oblique;
}
tbody {
    height: 450px;
    display: inline-block;
    width: 100%;
    overflow: auto;
}

</style>


<h3>

<th width="84%"> Consulta de Stock actual (Administrativo)</th>    
<th width="8%" align="right"> <a style="padding-top: 8px;" href="{{URL::to('descargaexcelstockadm')}}"  title="Descarga Stock administrativo"><img width="60px" src="{{asset('img/downloadXL.gif')}}"></a></th>
<th width="8%" align="right"> <a style="padding-top: 8px;" href="{{URL::to('descargaexcelkardex')}}" title="Descarga Kardex"><img width="45px" src="{{asset('img/kardex.jpg')}}"></a></th> 
</h3>                      
(Incluye mercaderías en estado Inactivo) <br>
<p align="right">
Si necesita elaborar el kardex luego de un día festivo, Haga click  
 <a style="padding-top: 8px;" href="{{URL::to('pantallaexcelkardexdescanso')}}" title="Descarga Kardex Día Festivo">aquí</a>                 
</p>


<br>


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
<thead> <th width="250px">GENERICO</th>
        @foreach ($locals as $local)
            <th width="55px">{{$local->codlocal3}}</th>
        @endforeach
        <th>TOTAL</th>
</thead> 
<tbody>
@foreach( $mercaderias as $key=>$value)
    <tr> 
        <td width="250px"> {{$value->codmarca3}}-{{$value->codtipo8}}-{{$value->codrango6}} </td> 
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
                <td width="55px">{{$value->$expresion[$i-1]}}</td>

        @endfor
        <td> {{$value->total}}</td> 

          
    </tr>
@endforeach
</tbody>
</table>


@stop
