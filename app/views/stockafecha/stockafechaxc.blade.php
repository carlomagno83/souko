<html>
<head>
<body>


<?php 
    $cantidad_locales = DB::table('locals')->count('id');
    $locals = DB::table('locals')->select('codlocal3')->orderby('id')->get();
    //$locals = DB::select("SELECT codlocal3 FROM locals");
    for ($i = 1; $i <= $cantidad_locales; $i++) 
    {
        $expresion[$i-1] = $locals[$i-1]->codlocal3 ;
    }   
    //dd($expresion[1]); 
?>

<table>
<thead> 
    <tr>   
        <td>GENERICO</td>
        @foreach ($locals as $local)
            <td>{{$local->codlocal3}}</td>
        @endforeach
    </tr>     
</thead> 
<tbody>
@foreach( $mercaderias as $key=>$value)
    <tr> 
        <td> {{$value->codmarca3}}-{{$value->codtipo8}}-{{$value->codrango6}} </td> 
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
                <td>{{$value->$expresion[$i-1]}}</td>

        @endfor
          
    </tr>
@endforeach
</tbody>
</table>

</body>
</html>
