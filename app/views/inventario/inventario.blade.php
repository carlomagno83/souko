@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Inventario por local</h3>
        Genera el archivo Excel de un Pto de Venta para verificar existencias (Usar Pistola escanner)
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
            </div>
        @endif
    </div>
</div>



<br>
<br>
<!--
<p>{{ link_to_route('mercaderias.create', 'Agregar Nueva Mercaderia', null, array('class' => 'btn btn-lg btn-success')) }}</p>
-->
<form method="POST" action="{{url('inventario-crear-archivo')}}">
<div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="material_id">Local</span>
                {{Form::select('local_id', [''=>''] + DB::table('locals')->orderby('codlocal3')->lists('codlocal3','id'), Input::get('local_id'),array('class'=>'form-control', 'required'=>'required'))}}
            </div>
        </div><!-- /.col-lg-6 -->
</div>  
<br>
<div class="row">
    <div class="col-lg-10">
    </div>
    <div class="col-lg-2">
                <button type="submit" class="btn btn-info">Crear Archivo Excel de Inventario</button>
    </div><!-- /.col-lg-6 -->     
</div> 
</form>


@stop
