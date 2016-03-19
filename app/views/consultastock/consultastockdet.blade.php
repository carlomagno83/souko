@extends('layouts.scaffold')
@section('main')

<h3>Consulta de stocks detallado</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </ul>
    </div>
@endif

<form method="POST" action="{{url('consulta-productos-filtrar')}}">
<div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="provider_id">Proveedor</span>
                {{Form::select('provider_id', [0=>''] + DB::table('providers')->orderby('desprovider')->lists('desprovider','id'), Input::get('provider_id'),array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="marca_id">Marca</span>
                {{Form::select('marca_id',[0=>''] + DB::table('marcas')->orderby('desmarca')->lists('desmarca','id'), Input::get('marca_id'),array('class'=>'form-control'))}}
           </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="tipo_id">Tipo</span>
                {{Form::select('tipo_id', [0=>''] + DB::table('tipos')->orderby('destipo')->lists('destipo','id'), Input::get('tipo_id'),array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="rango_id">Rango</span>
                {{Form::select('rango_id',[0=>''] + DB::table('rangos')->orderby('desrango')->lists('desrango','id'), Input::get('rango_id'),array('class'=>'form-control'))}}
           </div>
        </div><!-- /.col-lg-6 -->

        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="modelo_id">Modelo</span>
                {{Form::select('modelo_id',[0=>''] + DB::table('modelos')->orderby('desmodelo')->lists('desmodelo','id'), Input::get('modelo_id'),array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="material_id">Material</span>
                {{Form::select('material_id', [0=>''] + DB::table('materials')->orderby('desmaterial')->lists('desmaterial','id'), Input::get('material_id'),array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->

        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="color_id">Color</span>
                {{Form::select('color_id',[0=>''] + DB::table('colors')->orderby('descolor')->lists('descolor','id'), Input::get('color_id'),array('class'=>'form-control'))}}
           </div>
        </div><!-- /.col-lg-6 -->

        <br>
</div>  
<br>
<div class="row">
    <div class="col-lg-10">
    </div>
    <div class="col-lg-2">
                <button type="submit" class="btn btn-info">Filtrar</button>
    </div><!-- /.col-lg-6 -->     
</div> 
</form>

<br>



@if (count($mercaderias) > 0)
<div class="jumbotron">

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
<thead> <th>CODIGO</th>
        @foreach ($locals as $local)
            <th>{{$local->codlocal3}}</th>
        @endforeach
        <th>TOTAL</th>
</thead> 
<tbody>
@foreach( $mercaderias as $key=>$value)
    <tr> 
        <td> {{$value->codproducto31}} </td> 
        @for ($i = 1; $i <= $cantidad_locales; $i++) 
                <td>{{$value->$expresion[$i-1]}}</td>

        @endfor
        <td><b> {{$value->total}} </b></td>
    </tr>
@endforeach
</tbody>
</table>
@endif 
</div>
</div>

@stop
