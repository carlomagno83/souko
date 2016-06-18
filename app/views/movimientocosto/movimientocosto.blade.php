@extends('layouts.scaffold')
@section('main')


<style>
table {
    width: 1350px;

}
thead {
    display: inline-block;
    width: 1350px;
    height: 50px;
    font-weight: bolder;
    font-style: oblique;
}
tbody {
    height: 550px;
    display: inline-block;
    width: 1350px;
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

<h3>Movimientos de Ingresos (compras) y costo promedio</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </ul>
        </div>
    @endif
<br>
<form method="POST" id="validadorjs" action="{{url('movimientocostobuscar')}}">
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

<?php $tit=1; ?>

<table class="table table-sm">
<tbody>
@foreach($resultados as $resultado)
<?php 
    $mayor=1;
    if($resultado->ene>$mayor) $mayor=$resultado->ene ; 
    if($resultado->feb>$mayor) $mayor=$resultado->feb ; 
    if($resultado->mar>$mayor) $mayor=$resultado->mar ; 
    if($resultado->abr>$mayor) $mayor=$resultado->abr ; 
    if($resultado->may>$mayor) $mayor=$resultado->may ; 
    if($resultado->jun>$mayor) $mayor=$resultado->jun ; 
    if($resultado->jul>$mayor) $mayor=$resultado->jul ; 
    if($resultado->ago>$mayor) $mayor=$resultado->ago ; 
    if($resultado->sep>$mayor) $mayor=$resultado->sep ; 
    if($resultado->oct>$mayor) $mayor=$resultado->oct ; 
    if($resultado->nov>$mayor) $mayor=$resultado->nov ; 
    if($resultado->dic>$mayor) $mayor=$resultado->dic ; 
?>

    @if($tit==1 or $tit % 15 == 0)

    <tr>
    <i><b>
    <td width="310px" bgcolor="#A9D0F5" style="border-right: 2px solid #FFFFFF;"><i><b> GENERICO </b></i></td>
    <td width="50px" bgcolor="#A9D0F5"><i><b> ENE </b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;">  </td>
    <td width="50px" bgcolor="#A9D0F5"><i><b> FEB </b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;">  </td>
    <td width="50px" bgcolor="#A9D0F5"><i><b> MAR </b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;">  </td>
    <td width="50px" bgcolor="#A9D0F5"><i><b> ABR </b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;">  </td>
    <td width="50px" bgcolor="#A9D0F5"><i><b> MAY </b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;">  </td>
    <td width="50px" bgcolor="#A9D0F5"><i><b> JUN </b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;">  </td>
    <td width="50px" bgcolor="#A9D0F5"><i><b> JUL </b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;">  </td>
    <td width="50px" bgcolor="#A9D0F5"><i><b> AGO </b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;">  </td>
    <td width="50px" bgcolor="#A9D0F5"><i><b> SEP </b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;">  </td>
    <td width="50px" bgcolor="#A9D0F5"><i><b> OCT </b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;">  </td>
    <td width="50px" bgcolor="#A9D0F5"><i><b> NOV </b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;">  </td>
    <td width="50px" bgcolor="#A9D0F5"><i><b> DIC </b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;">  </td>
    
    </tr>

    <tr>
    <td width="310px" bgcolor="#A9D0F5" style="border-right: 2px solid #FFFFFF;"><i><b></b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Cant</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Costo</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Cant</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Costo</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Cant</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Costo</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Cant</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Costo</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Cant</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Costo</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Cant</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Costo</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Cant</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Costo</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Cant</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Costo</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Cant</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Costo</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Cant</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Costo</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Cant</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Costo</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Cant</b></i></td>
    <td width="50px" bgcolor="#A9D0F5" style="border-right: 1px solid #FFFFFF;"><i><b>Costo</b></i></td>


    </tr>

    @endif
<?php $tit++ ?>
    <tr>
    <td width="310px" style="border-right: 2px solid #0B3B39;"> {{$resultado->codmarca3}}-{{$resultado->codtipo8}}-{{$resultado->codrango6}} </td>
    
    @if($resultado->ene==$mayor)
    <td width="50px" bgcolor="#CEF6CE"> {{$resultado->ene}} </td>
    <td width="50px" bgcolor="#CEF6CE" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->enep == "") 0.00 @else {{$resultado->enep}} @endif </td>    
    @else
    <td width="50px"> {{$resultado->ene}} </td>
    <td width="50px" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->enep == "") 0.00 @else {{$resultado->enep}} @endif </td>
    @endif
    
    @if($resultado->feb==$mayor)
    <td width="50px" bgcolor="#CEF6CE"> {{$resultado->feb}} </td>
    <td width="50px" bgcolor="#CEF6CE" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->febp == "") 0.00 @else {{$resultado->febp}} @endif </td>
    @else
    <td width="50px"> {{$resultado->feb}} </td>
    <td width="50px" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->febp == "") 0.00 @else {{$resultado->febp}} @endif </td>
    @endif
    
    @if($resultado->mar==$mayor)
    <td width="50px" bgcolor="#CEF6CE"> {{$resultado->mar}} </td>
    <td width="50px" bgcolor="#CEF6CE" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->marp == "") 0.00 @else {{$resultado->marp}} @endif </td>
    @else
    <td width="50px"> {{$resultado->mar}} </td>
    <td width="50px" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->marp == "") 0.00 @else {{$resultado->marp}} @endif </td>
    @endif
    
    @if($resultado->abr==$mayor)
    <td width="50px" bgcolor="#CEF6CE"> {{$resultado->abr}} </td>
    <td width="50px" bgcolor="#CEF6CE" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->abrp == "") 0.00 @else {{$resultado->abrp}} @endif</td>
    @else
    <td width="50px"> {{$resultado->abr}} </td>
    <td width="50px" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->abrp == "") 0.00 @else {{$resultado->abrp}} @endif</td>
    @endif

    @if($resultado->may==$mayor)
    <td width="50px" bgcolor="#CEF6CE"> {{$resultado->may}} </td>
    <td width="50px" bgcolor="#CEF6CE" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->mayp == "") 0.00 @else {{$resultado->mayp}} @endif </td>
    @else
    <td width="50px"> {{$resultado->may}} </td>
    <td width="50px" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->mayp == "") 0.00 @else {{$resultado->mayp}} @endif </td>
    @endif
    
    @if($resultado->jun==$mayor)
    <td width="50px" bgcolor="#CEF6CE"> {{$resultado->jun}} </td>
    <td width="50px" bgcolor="#CEF6CE" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->junp == "") 0.00 @else {{$resultado->junp}} @endif </td>
    @else
    <td width="50px"> {{$resultado->jun}} </td>
    <td width="50px" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->junp == "") 0.00 @else {{$resultado->junp}} @endif </td>
    @endif
    
    @if($resultado->jul==$mayor)
    <td width="50px" bgcolor="#CEF6CE"> {{$resultado->jul}} </td>
    <td width="50px" bgcolor="#CEF6CE" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->julp == "") 0.00 @else {{$resultado->julp}} @endif </td>
    @else
    <td width="50px"> {{$resultado->jul}} </td>
    <td width="50px" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->julp == "") 0.00 @else {{$resultado->julp}} @endif </td>
    @endif
    
    @if($resultado->ago==$mayor)
    <td width="50px" bgcolor="#CEF6CE"> {{$resultado->ago}} </td>
    <td width="50px" bgcolor="#CEF6CE" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->agop == "") 0.00 @else {{$resultado->agop}} @endif </td>
    @else
    <td width="50px"> {{$resultado->ago}} </td>
    <td width="50px" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->agop == "") 0.00 @else {{$resultado->agop}} @endif </td>
    @endif
    
    @if($resultado->sep==$mayor)
    <td width="50px" bgcolor="#CEF6CE" bgcolor="#CEF6CE"> {{$resultado->sep}} </td>
    <td width="50px" bgcolor="#CEF6CE" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->sepp == "") 0.00 @else {{$resultado->sepp}} @endif </td>
    @else
    <td width="50px"> {{$resultado->sep}} </td>
    <td width="50px" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->sepp == "") 0.00 @else {{$resultado->sepp}} @endif </td>
    @endif
    
    @if($resultado->oct==$mayor)
    <td width="50px" bgcolor="#CEF6CE"> {{$resultado->oct}} </td>
    <td width="50px" bgcolor="#CEF6CE" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->octp == "") 0.00 @else {{$resultado->octp}} @endif </td>
    @else
    <td width="50px"> {{$resultado->oct}} </td>
    <td width="50px" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->octp == "") 0.00 @else {{$resultado->octp}} @endif </td>
    @endif
    
    @if($resultado->nov==$mayor)
    <td width="50px" bgcolor="#CEF6CE"> {{$resultado->nov}} </td>
    <td width="50px" bgcolor="#CEF6CE" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->novp == "") 0.00 @else {{$resultado->novp}} @endif </td>
    @else
    <td width="50px"> {{$resultado->nov}} </td>
    <td width="50px" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->novp == "") 0.00 @else {{$resultado->novp}} @endif </td>
    @endif
    
    @if($resultado->dic==$mayor)
    <td width="50px" bgcolor="#CEF6CE"> {{$resultado->dic}} </td>
    <td width="50px" bgcolor="#CEF6CE" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->dicp == "") 0.00 @else {{$resultado->dicp}} @endif </td>
    @else
    <td width="50px"> {{$resultado->dic}} </td>
    <td width="50px" align="right" style="border-right: 1px solid #cdd0d4;"> @if($resultado->dicp == "") 0.00 @else {{$resultado->dicp}} @endif </td>
    @endif

    </tr>
@endforeach
</tbody>
</table>















@endif

@stop
