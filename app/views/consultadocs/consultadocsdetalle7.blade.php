@extends('layouts.scaffold')

@section('main')

<h3>Detalle Devolución a Proveedor</h3>

@foreach ($documentos as $documento)
<div class="alert alert-info" >
    <div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="cantidaditem"># Documento</span>
                <input type="text"  value="{{$documento->id}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>       
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="cantidaditem">Doc. Físico</span>
                <input type="text"  value="{{$documento->numdocfisico}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>       
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="cantidaditem">Fecha Doc</span>
                <input type="text"  value="{{$documento->fechadocumento}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>
        <br>
        <br>
        <br>       
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="cantidaditem">Proveedor</span>
                <input type="text"  value="{{$documento->codprovider3}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>       
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="cantidaditem">Cantidad Items</span>
                <input type="text"  value="{{$documento->cantidad}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>       
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="cantidaditem">Total compra</span>
                <input type="text"  value="{{$documento->totalcompra}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>    

    </div>
</div>
@endforeach




<table class="table table-striped">
    <thead>
        <tr>
            <th width="15%"># Mercadería</th>
            <th width="25%">CodProducto31</th>             
            <th width="20%">Precio Compra</th>
        </tr>    
    </thead>


        @foreach ($detalles as $detalle)
        <tr>
            <td width="15%"><input type="text" name="id[]" id="id[]" value="{{$detalle->id}}" class="form-control" readonly tabindex="-1"></td>
            <td width="25%"><input type="text"  value="{{$detalle->codproducto31}}" readonly class="form-control" tabindex="-1"></td>
            <td width="20%"><input type="text"  value="{{$detalle->preciocompra}}" readonly class="form-control" tabindex="-1"></td>
            <td width="5%"><a href="{{URL::to('consultamercaderia/'.$detalle->id)}}" target="_blank"><img width="30px" src="{{asset('img/lupa.png')}}"></a></td>
        </tr>
        @endforeach
</table>


@stop


