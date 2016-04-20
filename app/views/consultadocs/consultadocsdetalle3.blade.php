@extends('layouts.scaffold')

@section('main')

<h3>Detalle Ventas</h3>

<form method="POST" action="{{url('eliminaguiaventa')}}">
@foreach ($documentos as $documento)
<div class="alert alert-info" >
    <div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" ># Documento</span>
                <input type="text" name="documento_id" id="documento_id" value="{{$documento->id}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>       
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon">Doc. Físico</span>
                <input type="text" id="numdocfisico" value="{{$documento->numdocfisico}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>       
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon">Fecha Doc</span>
                <input type="text"  value="{{$documento->fechadocumento}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>
        <?php
        $ultimo = DB::table('documentos')->select('id')->where('tipomovimiento_id','3')->orderBy('id', 'desc')->pluck('id')
        ?>
        @if ($ultimo==$documento->id)
        <div class="col-lg-3"  align="right">
            <div class="input-group">
                <strong><mark>Elimina Doc x emergencia</mark></strong><input type="image" name="submit" src="{{asset('img/skull.png')}}" onclick="return confirm('Se va a proceder a eliminar el último documento de venta ingresado ¿Estas seguro de querer eliminarlo?');">
                
            </div>
        </div>  
        @endif     
        <br>
        <br>
        <br>       
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon">Pto de Venta</span>
                <input type="text"  value="{{$documento->codlocal3}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>       
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon">Cantidad Items</span>
                <input type="text"  value="{{$documento->cantidad}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>       
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon">Total Ventas</span>
                <input type="text"  value="{{$documento->totalventa}}" readonly class="form-control" tabindex="-1">
            </div>
        </div>    
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon">Total Sugerido (Act)</span>
                <input type="text"  value="{{$documento->totalsugerido}}" readonly class="form-control" tabindex="-1">
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
            <th width="20%">Precio Venta</th>
            <th width="25%">Vendedor</th>
        </tr>    
    </thead>


        @foreach ($detalles as $detalle)
        <tr>
            <td width="15%"><input type="text" name="id[]" id="id[]" value="{{$detalle->id}}" class="form-control" readonly tabindex="-1"></td>
            <td width="25%"><input type="text"  value="{{$detalle->codproducto31}}" readonly class="form-control" tabindex="-1"></td>
            <td width="20%"><input type="text"  value="{{$detalle->precioventa}}" readonly class="form-control" tabindex="-1"></td>
            <td width="25%"><input type="text"  value="{{$detalle->desusuario}}" readonly class="form-control" tabindex="-1"></td>
            <td width="5%"><a href="{{URL::to('consultamercaderia/'.$detalle->id)}}" target="_blank"><img width="30px" src="{{asset('img/lupa.png')}}"></a></td>
        </tr>
        @endforeach
</table>

</form>

@stop


