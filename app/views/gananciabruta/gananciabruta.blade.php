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


<script>
$("form").ready(function() {
    $("#validadorjs").validate({
        rules: {
              mes: {
                  required: true,
              },
              anho: {
                  required: true,
                  min: 2015,
                  max: 2050,
                  number: true
            }           
        },
        messages: {
        }
    });
});
</script>

<h3>Ganancia bruta por Punto de Venta</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </ul>
        </div>
    @endif
<br>
<form method="POST" id="validadorjs" action="{{url('gananciabrutabuscar')}}">
<div class="row">
    <div class="col-lg-2">
        <div class="input-group">
            <span class="input-group-addon">Año</span>
            <input type="text" id="anho" name="anho" value={{date("Y")}} Input::get('anho') class="form-control" aria-describedby="basic-addon1">
        </div>
    </div><!-- /.col-lg-6 -->

    <div class="col-lg-3">
        {{ Form::submit('Consultar', array('class' => 'btn btn-info')) }}
    </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
</form>
<br>
<br>
<br>


@if (count($resultados)>0)

<br>

<?php 
    $cantidad_locales = DB::table('locals')->where('id','<>',1)->count('id');
    $puntos=$cantidad_locales+1;
    $locals = DB::table('locals')->select('codlocal3')->where('id','<>',1)->orderby('id')->get();
    $todo = count($resultados)-1 ;
    $key=0;
    

?>
RESULTADOS PARA EL AÑO {{Input::get('anho') }}
<br>
<br>
<table class="table table-hover table-striped">
<thead> 
    <tr>
    <td width="120px">MESES</td>
    @foreach ($locals as $local)
        <td width="75px" align="right">{{$local->codlocal3}}</td>
    @endforeach
    <td width="120px" align="right">TOTAL</td>
    </tr>
</thead> 
<tbody>


@for($m = 1; $m <= 12; $m++)
    <tr> 
    <?php $suma=0; ?>
    @if($m == 1) <td width="120px"> ENERO </td> @endif
    @if($m == 2) <td width="120px"> FEBRERO </td> @endif
    @if($m == 3) <td width="120px"> MARZO </td> @endif
    @if($m == 4) <td width="120px"> ABRIL </td> @endif
    @if($m == 5) <td width="120px"> MAYO </td> @endif
    @if($m == 6) <td width="120px"> JUNIO </td> @endif
    @if($m == 7) <td width="120px"> JULIO </td> @endif
    @if($m == 8) <td width="120px"> AGOSTO </td> @endif
    @if($m == 9) <td width="120px"> SEPTIEMBRE </td> @endif
    @if($m == 10) <td width="120px"> OCTUBRE </td> @endif
    @if($m == 11) <td width="120px"> NOVIEMBRE </td> @endif
    @if($m == 12) <td width="120px"> DICIEMBRE </td> @endif
    
@if($key>$todo)
    @for($p = 2 ; $p <= $puntos ; $p++)
        <td width="75px" align="right">0.00</td>
    @endfor    
@else    
    @if($resultados[$key]->mes==$m)
        @for($p = 2 ; $p <= $puntos ; $p++)
            @if($key>$todo)
                <td width="75px" align="right">0.00</td>
            @else
                <?php $localcod = $resultados[$key]->local_id; ?>
                @if( $localcod == $p)
                    <td width="75px" align="right"> {{$resultados[$key]->total}} </td>
                    <?php $suma=$suma+$resultados[$key]->total; $key=$key+1; ?>
                @else
                    <td width="75px" align="right">0.00</td>    
                @endif
            @endif
        @endfor
    @else
        @for($p = 2 ; $p <= $puntos ; $p++)
            <td width="75px" align="right">0.00</td>
            <?php $suma=$suma+0;  ?>
        @endfor     
    @endif    

@endif   
    <td width="120px" align="right">{{number_format($suma, 2)}}</td>
    </tr>  

@endfor  

</tbody>
</table>

@endif

@stop
