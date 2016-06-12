<html>
<head>
<body>
<?php 
    $cantidad_locales = DB::table('locals')->count('id');
    $locals = DB::table('locals')->select('codlocal3')->orderby('id')->get();

    for ($i = 1; $i <= $cantidad_locales; $i++) 
    {

        $expresion[$i-1] = $locals[$i-1]->codlocal3 ;
    }   

?>

<table>
<thead> 
        <tr>
        <th>{{date('Y-m-d')}}</th>
        @foreach ($locals as $local)
            <th>{{$local->codlocal3}}</th>
        @endforeach
        <th>TOTAL</th>
        </tr>
</thead> 
<tbody>
@foreach( $mercaderias as $key=>$value)
    <tr> 
        <td> {{$value->codmarca3}}-{{$value->codtipo8}}-{{$value->codrango6}} </td> 
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
                <td>{{$value->$expresion[$i-1]}}</td>

        @endfor
        <td> {{$value->total}}</td> 

          
    </tr>
@endforeach
</tbody>
</table>
</div>

</body>
</html>
