@extends('layouts.scaffold')

@section('main')

<form method="POST">

<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Registro de Ventas a final de día</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>


<div class="row">
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="usuario_id">Usuario Vendedor</span>
                {{Form::select('usuario_id', [0=>'Seleccione'] + DB::table('users')->where('rolusuario',"VENDE")->orderby('desusuario')->lists('desusuario','id'),null,array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->

        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="local_id">Local o Pto de Venta</span>
                {{Form::select('local_id',[0=>'Seleccione'] + DB::table('locals')->where('deslocal','<>','ALMACEN')->orderby('deslocal')->lists('deslocal','id'),null,array('class'=>'form-control'))}}
           </div>
        </div><!-- /.col-lg-6 -->    
</div><!-- /.row -->



<!-- llenando la tabla -->
<br>
<div class="row">
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="mercaderia_id">Mercadería</span>
            <input type="text" class="form-control" placeholder="Uso de pistola" aria-describedby="basic-addon1">
       </div>
    </div><!-- /.col-lg-6 -->  
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="mercaderia_id">Precio de venta</span>
            <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
       </div>
    </div><!-- /.col-lg-6 -->    
    <div class="col-lg-4">
      {{ Form::submit('Agregar', array('class' => 'btn btn-lg btn-primary')) }}
    </div>
    [Aparece codproducto31] 
</div><!-- /.row -->
<br>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Mercadería</th>
            <th>codproducto31</th>
            <th>Precio</th>
    </thead>
<!-- en duro para llenar uno por uno-->
    <tbody>
        <tr>
            <td><input type="text" name="mercaderia_id1"></td>
            <td><input type="text" name="codproducto311" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="precio1"></td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id2" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="codproducto312" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="precio2"></td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id3" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="codproducto313" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="precio3"></td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id4" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="codproducto314" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="precio4"></td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id5" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="codproducto315" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="precio5"></td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
    </tbody>
</table>

    <div class="col-lg-4">
      {{ Form::submit('Finalizar', array('class' => 'btn btn-lg btn-primary')) }}
    </div>
{{ Form::close() }}    
<br>
<br>
<br>
<br>



@stop


