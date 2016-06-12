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
    <th>CODIGO</th>
    @foreach ($locals as $local)
        <th>{{$local->codlocal3}}</th>
    @endforeach
    </tr>
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
<tfoot>
@foreach( $totales as $key=>$value)
    <tr> 
        <td><big><b>TOTAL ITEMS </b></big></td> 
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
                <td><big><b>{{$value->$expresion[$i-1]}}</b></big></td>
        @endfor
    </tr>
</tfoot>
@endforeach
</table>

</body>
</html>

