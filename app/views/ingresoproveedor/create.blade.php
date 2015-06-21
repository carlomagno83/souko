@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Ingreso de mercadería desde el proveedor</h3>

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

<form method="POST" action="{{url('ingresos-proveedor-create')}}">

    <h3>Filtrar Productos</h3>
    <div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="marca_id">Marca</span>
                {{Form::select('marca_id',[0=>'Seleccione'] + DB::table('marcas')->lists('desmarca','id'),null,array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->

        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="tipo_id">Tipo</span>
                {{Form::select('tipo_id',[0=>'Seleccione'] + DB::table('tipos')->lists('destipo','id'),null,array('class'=>'form-control'))}}
           </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="modelo_id">Modelo</span>
                {{Form::select('modelo_id',[0=>'Seleccione'] + DB::table('modelos')->lists('desmodelo','id'),null,array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="color_id">Color</span>
                {{Form::select('color_id',[0=>'Seleccione'] + DB::table('colors')->lists('descolor','id'),null,array('class'=>'form-control'))}}
           </div>
        </div><!-- /.col-lg-6 -->
    </div>
    <br>

    <div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="material_id">Material</span>
                {{Form::select('material_id',[0=>'Seleccione'] + DB::table('materials')->lists('desmaterial','id'),null,array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="rango_id">Rango id</span>
                {{Form::select('rango_id',[0=>'Seleccione'] + DB::table('rangos')->lists('desrango','id'),null,array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon" id="talla_id">Talla</span>
                {{Form::select('talla_id',[0=>'Seleccione'] + DB::table('tallas')->lists('destalla','id'),null,array('class'=>'form-control'))}}
           </div>
        </div><!-- /.col-lg-6 -->
    </div>
    <br>
    <div class="row">
        <div class="col-lg-6">
            <div class="input-group">
                <input type="submit" value="Filtrar" class="btn btn-danger">
                <a href="ingresos-proveedor-create" class="btn btn-black">Limpiar Filtros</a>
            </div>
        </div><!-- /.col-lg-6 -->
    </div>

</form>

<br>
<br>
<br>

<form method="POST" action="{{url('ingresos-proveedor-store')}}">

<div class="row">

    <div class="col-lg-6">
        <div class="input-group">
            <span class="input-group-addon">Tipo de movimiento</span>
            {{Form::select('tipomovimiento_id',DB::table('tipomovimientos')->lists('destipomovimiento','id'),null,array('class'=>'form-control'))}}
        </div>
    </div>

</div>
<br>

    <table class="table" id="grilla1">

        <tr>
            <th>Cod Producto</th>
            <th>Nombre</th>
            <th>Cantidad <strong>(Sólo cantidades > 0 se guardan)</strong></th>
        </tr>

        @foreach ($productos as $producto)
        <tr>
            <td><input type="text" name="producto_id[]" id="producto_id[]" value="{{$producto->id}}" class="form-control" readonly></td>
            <td><input type="text"  value="{{$producto->codproducto31}}" readonly class="form-control"></td>
            <td><input type="text" name="cantidad[]" id="cantidad[]" class="form-control"></td>
        </tr>
        @endforeach

    </table>

    <input type="submit" value="Ingresar mercaderías y generar Códigos" class="btn btn-lg btn-primary">

</form>

<br>
<br>


@stop


