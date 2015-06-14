@extends('layouts.scaffold')

@section('main')

<form method="POST">

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


 
 <!--       <div class="form-group">
            {{ Form::label('mercaderia_id', 'Mercaderia_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'mercaderia_id', Input::old('mercaderia_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('documento_id', 'Documento_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'documento_id', Input::old('documento_id'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('flagoferta', 'Flagoferta:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('flagoferta', Input::old('flagoferta'), array('class'=>'form-control', 'placeholder'=>'Flagoferta')) }}
            </div>
        </div>
-->
<div class="row">
    <div class="col-lg-3">
        <div class="input-group">
            Proveedor<input type="text" name="proveedor_id" aria-describedby="basic-addon1">        
        </div>
    </div><!-- /.col-lg-6 -->    
    <div class="col-lg-3">
        <div class="input-group">
            Tipo de Movimiento<input type="text" name="tipomovimiento_id" aria-describedby="basic-addon1">
        </div>
    </div><!-- /.col-lg-6 -->
    
    <div class="col-lg-3">
        <div class="input-group">
            Local Inicial<input type="text" name="localini_id" aria-describedby="basic-addon1">
       </div>
    </div><!-- /.col-lg-6 -->
    <div class="col-lg-3">
        <div class="input-group">
            Local Final<input type="text" name="localfin_id" aria-describedby="basic-addon1">
        </div>
    </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<!-- llenando la tabla -->
Para llenar detalle -> sin uso
<div class="row">
    <div class="col-lg-2">
        <div class="input-group">
            Marca<input type="text" name="marca_id" aria-describedby="basic-addon1">
        </div>
    </div><!-- /.col-lg-6 -->
    
    <div class="col-lg-3">
        <div class="input-group">
            Tipo     .<input type="text" name="tipo_id" aria-describedby="basic-addon1">
       </div>
    </div><!-- /.col-lg-6 -->
    <div class="col-lg-3">
        <div class="input-group">
            <span class="input-group-addon" id="modelo_id">Modelo id</span>
            <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
        </div>
    </div><!-- /.col-lg-6 -->    
    <div class="col-lg-3">
        <div class="input-group">
            <span class="input-group-addon" id="color_id">Color</span>
            <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
       </div>
    </div><!-- /.col-lg-6 -->    
</div><!-- /.row -->

<div class="row">
    <div class="col-lg-2">
        <div class="input-group">
            <span class="input-group-addon" id="material_id">Material</span>
            <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
        </div>
    </div><!-- /.col-lg-6 -->
    <div class="col-lg-3">
        <div class="input-group">
            <span class="input-group-addon" id="rango_id">Rango id</span>
            <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
        </div>
    </div><!-- /.col-lg-6 -->  
    <div class="col-lg-3">
        <div class="input-group">
            <span class="input-group-addon" id="talla">Talla</span>
            <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
       </div>
    </div><!-- /.col-lg-6 -->    
</div><!-- /.row -->
<br>
<div class="row">
    <div class="col-lg-3">
        <div class="input-group">
            <td>Cantidad<input type="text" name="cantidad" aria-describedby="basic-addon1"></td>
        </div>
    </div><!-- /.col-lg-6 -->  
    <div class="col-lg-3">
        <div class="input-group">
            <span class="input-group-addon" id="preciocompra">Precio por unidad</span>
            <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
        </div>
        Informa ultimo precio de compra
    </div><!-- /.col-lg-6 -->      
    <div class="col-lg-3">
      {{ Form::submit('graba', array('class' => 'btn btn-lg btn-primary')) }}

    </div>
</div>
</div><!-- /.row -->
<br>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Producto id</th>
            <th>Cantidad</th>
    </thead>
<!-- en duro para llenar uno por uno-->
En duro para llenar uno por uno
    <tbody>
        <tr>
            <td><input type="text" name="producto_id1" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="cantidad1" aria-describedby="basic-addon1"></td>
            <td>

                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}

            </td>
        </tr>
        <tr>
            <td><input type="text" name="producto_id2" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="cantidad2" aria-describedby="basic-addon1"></td>
            <td>

                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}

            </td>
        </tr>
        <tr>
            <td><input type="text" name="producto_id3" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="cantidad3" aria-describedby="basic-addon1"></td>
            <td>

                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}

            </td>
        </tr>
        <tr>
            <td><input type="text" name="producto_id4" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="cantidad4" aria-describedby="basic-addon1"></td>
            <td>

                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}

            </td>
        </tr>
        <tr>
            <td><input type="text" name="producto_id5" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="cantidad5" aria-describedby="basic-addon1"></td>
            <td>

                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}

            </td>
        </tr>
    </tbody>
</table>

    <div class="col-lg-4">
      {{ Form::submit('Ingresar mercaderías y generar Códigos', array('class' => 'btn btn-lg btn-primary')) }}
    </div>
 
<br>
<br>
<br>
<br>

</form>

@stop


