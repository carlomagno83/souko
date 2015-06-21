@extends('layouts.scaffold')

@section('main')

<h2>Todos los movimientos</h2>

{{--<a href="{{url('ingresos-proveedor-create')}}" class='btn btn-lg btn-success'>Nuevo ingreso Proveedor</a>--}}

<table class="table table-striped">
    <thead>
        <tr>
            <th>Código Mercaderia</th>
            <th>Código Documento</th>
            <th>Oferta</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($movimientos as $movimiento)
            <tr>
                <td>{{{ $movimiento->mercaderia_id }}}</td>
                <td>{{{ $movimiento->documento_id }}}</td>
                <td>{{{ $movimiento->flagoferta }}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@stop
