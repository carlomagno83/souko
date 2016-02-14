@extends('layouts.scaffold')

@section('main')

{{--<div align="right">--}}
    {{--<a id="home" href=" {{ URL::to('/') }} "><img src='img/home.ico' border='0'></a>--}}
{{--</div>--}}
<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Re imprime Etiquetas según guía de Entrada</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>


<form method="POST" action="{{url('reimprimeguiaentrada-buscar')}}">

    <div class="row">
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="documento_id">Número de documento</span>
                <input type="text" class="form-control" name="documento_id" Input::old('documento_id') aria-describedby="basic-addon1">
            </div>

        </div><!-- /.col-lg-6 -->

        <div class="col-lg-6">
            <div class="input-group">
                <input type="submit" value="Buscar Documento" class=" btn btn-success"> 
            </div>
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
    <div class="row">
    </div><!-- /.row -->
    <br>
</form>

<form method="POST" action="{{url('reimprimeguiaentrada-buscarfisico')}}">

    <div class="row">
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="documento_id">Documento Físico</span>
                <input type="text" class="form-control" name="numdocfisico" Input::old('numdocfisico') aria-describedby="basic-addon1">
            </div>
        </div><!-- /.col-lg-6 -->

        <div class="col-lg-6">
            <div class="input-group">
                <input type="submit" value="Buscar por Documento Físico" class=" btn btn-success"> 
            </div>
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
    <div class="row">
    </div><!-- /.row -->
    <br>
</form>

<form method="POST" action="{{url('reimprimeguiaentrada-reimprime')}}">
@if (count($mercaderias)>0)
<h4>
    <div class="row">
        <div class="col-lg-2">
            <div class="input-group">
                <h4>No. Documento :</h4>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="input-group">
                 <input type="text" name="documento_id" id="documento_id" value="{{$documentos->id}}" class="form-control" readonly tabindex="-1">
            </div>
        </div>
        <div class="col-lg-1">
            <div class="input-group">
            </div>
        </div>   
        <div class="col-lg-1">
            <div class="input-group">
                <h4>Fecha :</h4>  
            </div>
        </div>
        <div class="col-lg-2">
            <div class="input-group">
                <input type="text" value="{{$documentos->fechadocumento }}" class="form-control" readonly tabindex="-1">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="input-group">
                <h4>Documento Físico :</h4>  
            </div>
        </div>
        <div class="col-lg-2">
            <div class="input-group">
                <input type="text" name="numdocfisico" id="numdocfisico" value="{{$documentos->numdocfisico }}" class="form-control" readonly tabindex="-1">
            </div>
        </div>
    

    </div> 
    <?php $desproveedor = DB::table('providers')->select('desprovider')->where('id', '=', $documentos->localini_id )->pluck('desprovider'); ?></h4>
    <div class="row">
        <div class="col-lg-2">
            <div class="input-group">
                <h4>Proveedor:   
            </div>
        </div>
        <div class="col-lg-2">
            <div class="input-group">
                <input type="text" value={{$desproveedor}} class="form-control" readonly tabindex="-1">
            </div>
        </div> 
        <div class="col-lg-5">
            <div class="input-group">
            </div>
        </div>     
        <div class="col-lg-3">
            <div class="input-group">
                <input type="submit" value="RE-Imprimir etiquetas" class="btn btn-info"> 
            </div>
        </div><!-- /.col-lg-6 -->      
    </div>
</h4>

@endif
<br>
<table class="table table-striped">
    <thead>
        <tr>
            <th width="15%">Mercadería id</th>
            <th width="15%">Producto id</th>
            <th>Descripción cod31</th>
            <th width="20%">Precio Compra</th>
    </thead>

    @if (count($mercaderias)>0)

       @foreach ($mercaderias as $mercaderia)
        <tr>
            <td width="15%"><input type="text" name="id[]" id="id[]" value="{{$mercaderia->id}}" class="form-control" readonly tabindex="-1"></td>
            <td width="15%"><input type="text" name="producto_id[]" id="producto_id[]" value="{{$mercaderia->producto_id}}" readonly class="form-control" tabindex="-1"></td>
            <td><input type="text"  value="{{$mercaderia->codproducto31}}" readonly class="form-control" tabindex="-1"></td>
            <td width="20%"><input type="text"  value="{{$mercaderia->preciocompra}}" readonly class="form-control" tabindex="-1"></td>
        </tr>
        @endforeach
    @endif
</table>


<br>
<br>
<br>
<br>

</form>

@stop


