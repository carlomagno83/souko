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
    $maxmov=0;
    if (count($movimientos) > 0) $maxmov=count($movimientos); 
    $key2=0;
    $fin=0;
    $comodin=0;
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

@if (count($movimientos) > 0)
@foreach( $mercaderias as $key=>$value)
    <tr>
    <?php 
        $gen1=$value->codmarca3."-".$value->codtipo8."-".$value->codrango6 ;
        if($key2<$maxmov)
        {
        $gen2=$movimientos[$key2]->codmarca3."-".$movimientos[$key2]->codtipo8."-".$movimientos[$key2]->codrango6 ;
        }
    ?> 

    @if($gen1 < $gen2 and $fin==0)
        <td> {{$value->codmarca3}}-{{$value->codtipo8}}-{{$value->codrango6}} </td> 
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
            <td>{{$value->$expresion[$i-1]}}</td>
        @endfor

    @endif
    @if($gen1 == $gen2 and $fin==0)
        <td> {{$value->codmarca3}}-{{$value->codtipo8}}-{{$value->codrango6}} </td> 
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
            <td>{{$value->$expresion[$i-1] + $movimientos[$key2]->$expresion[$i-1]}}</td>
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
        ?>
    @endif
    @if($gen1 > $gen2 and $fin==1)
        <td> {{$value->codmarca3}}-{{$value->codtipo8}}-{{$value->codrango6}} </td> 
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
            <td>{{$value->$expresion[$i-1]}}</td>
        @endfor
    @endif 

    @if($gen1 > $gen2 and $fin==0)
       <td> {{$movimientos[$key2]->codmarca3}}-{{$movimientos[$key2]->codtipo8}}-{{$movimientos[$key2]->codrango6}} </td>
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
            <td>{{$movimientos[$key2]->$expresion[$i-1]}}</td>
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
            <td> {{$movimientos[$key2]->codmarca3}}-{{$movimientos[$key2]->codtipo8}}-{{$movimientos[$key2]->codrango6}} </td>
            @for ($i = 1; $i <= $cantidad_locales; $i++) 
                <td>{{$movimientos[$key2]->$expresion[$i-1]}}</td>
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
@endforeach
@endif


@if (count($movimientos) == 0)
@foreach( $mercaderias as $key=>$value)
    <tr>
        <td> {{$value->codmarca3}}-{{$value->codtipo8}}-{{$value->codrango6}} </td> 
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
            <td>{{$value->$expresion[$i-1]}}</td>
        @endfor
    </tr>
@endforeach
@endif
</tbody>
</table>

</body>
</html>
