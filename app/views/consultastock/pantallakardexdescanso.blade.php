@extends('layouts.scaffold')
@section('main')

<img src="img/descanso.png" alt="descanso" >
<h3>Elabora kardex para días de descanso</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </ul>
    </div>
@endif

<form method="GET" action="{{url('descargaexcelkardexdescanso')}}">

<br>
<div class="row">
    <div class="col-lg-7">
    </div>
    <div class="col-lg-2">
                <button type="submit" id="consultabutton" class="btn btn-lg btn-success">Imprimir Kardex</button>
    </div><!-- /.col-lg-6 -->  
</form>       
    <div class="col-lg-3">
                <form action="{{url('consultastockadm')}}">
                <button class="btn btn-lg btn-info" type="submit" value="Regresar a la pantalla anterior">Regresar a la pantalla anterior</button>
                </form>
    </div><!-- /.col-lg-6 -->     
</div> 


<br>


</div>

@stop
