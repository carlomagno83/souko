<html>
<head>
<body>
<?php 
    $cantidad_locales = DB::table('locals')->count('id');
    $locals = DB::table('locals')->select('id','codlocal3')->get();

    $cant_loc_ind = $cantidad_locales - 1 ;
    $ind = 0;
    $key = 0;
    
//dd($mercaderias);    
//dd($cant_loc_ind);    
//dd($locals[$key]->codlocal3);
//dd(count($mercaderias));
//dd((intval(count($mercaderias)/54) + 1)*2);
    $registros = count($mercaderias) + (intval(count($mercaderias)/54) + 1)*2 ; //agrega lineas de cabecera por hoja
    //dd($registros);
    //dd($mercaderias[7]->{$locals[1]->codlocal3});
    
    //dd($mercaderias[5]->ALM);

    for ($i = 1; $i <= $cantidad_locales; $i++) 
    {

        $expresion[$i-1] = $locals[$i-1]->codlocal3 ;
    }   

?>

<table>
@for ($a = 1; $a <= $registros; $a++) 

    @if($a==1 or $a==57 or $a==113 or $a==169 or $a==225 or $a==281 or $a==337 or $a==2 or $a==58 or $a==114 or $a==170 or $a==226 or $a==282 or $a==338 ) 
        @if($a==1 or $a==57 or $a==113 or $a==169 or $a==225 or $a==281 or $a==337 )
            <tr> 
            @foreach ($locals as $local)
                <td>{{ date('Y-m-d', strtotime( "-1 day")) }}</td>
                <td></td>
                <td></td>
                <td>{{$local->codlocal3}}</td>
                <td></td>
            @endforeach
            </tr>
        @else
            <tr> 
            @foreach ($locals as $local)
                <td>Descripcion</td>
                <td>Ing</td>
                <td>Sal</td>
                <td>Ven</td>
                <td>Total</td>
            @endforeach
            </tr>
        @endif    
    @else
        <tr> 

        @for ($k = 0; $k <= $cant_loc_ind; $k++) 
            
            <td> {{$mercaderias[$ind]->codmarca3}}-{{$mercaderias[$ind]->codtipo8}}-{{$mercaderias[$ind]->codrango6}} </td> 
<?php
//dd($locals[$k]->id);
if($locals[$k]->id == 1) 
{
    $sql = "SELECT fechadocumento, 
                        COUNT(if(movimientos.tipomovimiento_id=1 AND localfin_id=".$locals[$k]->id." ,1,NULL)) AS cta_pro_ing,
                        COUNT(if(movimientos.tipomovimiento_id=2  ,1,NULL)) AS cta_alm_ing, 
                        COUNT(if(movimientos.tipomovimiento_id=6 AND localfin_id=1 ,1,NULL)) AS cta_dev_sal,
                        COUNT(if(movimientos.tipomovimiento_id=7 AND localini_id=1 ,1,NULL)) AS  cta_dev_prov_sal

    from movimientos
    INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
    INNER JOIN mercaderias ON movimientos.mercaderia_id=mercaderias.id
    INNER JOIN productos ON mercaderias.producto_id=productos.id
    WHERE fechadocumento = date(CURDATE()-1) 
        and marca_id=".$mercaderias[$ind]->marca_id."
        and tipo_id=".$mercaderias[$ind]->tipo_id."
        and rango_id=".$mercaderias[$ind]->rango_id."
    GROUP BY fechadocumento";
}   
else
{ 
    $sql = "SELECT fechadocumento, 
                        COUNT(if(movimientos.tipomovimiento_id=2 AND localfin_id=".$locals[$k]->id." ,1,NULL)) AS cta_alm_ing, 
        COUNT(if(movimientos.tipomovimiento_id=3 AND devolucion=0 AND localfin_id=".$locals[$k]->id." ,1,NULL)) AS cta_vta_sal, 
        COUNT(if(movimientos.tipomovimiento_id=3 AND devolucion<0  AND localfin_id=".$locals[$k]->id." ,1,NULL)) AS cta_cambio, 
                        COUNT(if(movimientos.tipomovimiento_id=4 AND localfin_id=".$locals[$k]->id." ,1,NULL)) AS cta_pto_ing, 
                        COUNT(if(movimientos.tipomovimiento_id=4 AND localini_id=".$locals[$k]->id." ,1,NULL)) AS cta_pto_sal, 
                        COUNT(if(movimientos.tipomovimiento_id=6 AND localini_id=".$locals[$k]->id." ,1,NULL)) AS cta_dev_sal


    from movimientos
    INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
    INNER JOIN mercaderias ON movimientos.mercaderia_id=mercaderias.id
    INNER JOIN productos ON mercaderias.producto_id=productos.id
    WHERE fechadocumento = date(CURDATE()-1) 
        and marca_id=".$mercaderias[$ind]->marca_id."
        and tipo_id=".$mercaderias[$ind]->tipo_id."
        and rango_id=".$mercaderias[$ind]->rango_id."
    GROUP BY fechadocumento";
}                      
    $movs = DB::select($sql);
   //dd($movs );

?>          
            @if($movs)  
                @if($locals[$k]->id == 1) <!--  En el caso de Almacen-->
                <td>{{$movs[0]->cta_pro_ing + $movs[0]->cta_dev_sal}}</td>
                <td>{{$movs[0]->cta_alm_ing + $movs[0]->cta_dev_prov_sal}}</td>
                <td>0</td>
                <td>{{ $mercaderias[$ind]->$expresion[$k] }}</td>    
                           
                @else           
                <td>{{$movs[0]->cta_alm_ing + $movs[0]->cta_pto_ing + $movs[0]->cta_cambio}}</td>
                <td>{{$movs[0]->cta_pto_sal + $movs[0]->cta_dev_sal}}</td>
                <td>{{$movs[0]->cta_vta_sal}}</td>
                <td>{{ $mercaderias[$ind]->$expresion[$k] }}</td> 
                @endif
            @else
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>{{ $mercaderias[$ind]->$expresion[$k] }}</td> 
            @endif            
   

        @endfor
        </tr>   

        <?php $ind = $ind + 1;
        
         ?>
    @endif    
@endfor
</table>





</body>
</html>
