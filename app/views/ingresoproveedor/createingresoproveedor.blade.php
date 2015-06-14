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


{{ Form::open(array('url' => 'ingresoproveedor', 'class' => 'form-horizontal')) }}

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
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="proveedor_id">Proveedor</span>
            <input type="text" name="provider_id" class="form-control" placeholder="Aviso de guias de devolucion sin liquidar" aria-describedby="basic-addon1">
        </div>
    </div><!-- /.col-lg-6 -->    
    <div class="col-lg-3">
        <div class="input-group">
            <span class="input-group-addon" id="tipomovimiento_id">Tipo de movimiento</span>
            <input type="text" placeholder="id" aria-describedby="basic-addon1">
        </div>
    </div><!-- /.col-lg-6 -->
    
    <div class="col-lg-2">
        <div class="input-group">
            <span class="input-group-addon" id="localini_id">Local inicial</span>
            <input type="text" placeholder="" aria-describedby="basic-addon1">
       </div>
    </div><!-- /.col-lg-6 -->
    <div class="col-lg-2">
        <div class="input-group">
            <span class="input-group-addon" id="localfin_id">Local final</span>
            <input type="text" placeholder="" aria-describedby="basic-addon1">
        </div>
    </div><!-- /.col-lg-6 -->
</div>
<!-- /.row -->

<!-- llenando la tabla -->
Para llenar detalle -> sin uso
<div class="row">
    <div class="col-lg-2">
        <div class="input-group">
            <span class="input-group-addon" id="marca_id">Marca id</span>
            <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
        </div>
    </div><!-- /.col-lg-6 -->
    
    <div class="col-lg-3">
        <div class="input-group">
            <span class="input-group-addon" id="tipo_id">Tipo id</span>
            <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
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
            <span class="input-group-addon" id="cantidad">Cantidad</span>
            <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
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
      {{ Form::button('Agregar', array('class' => 'btn btn-lg btn-primary','onclick'=>'agrega()')) }}

    </div>
</div>
</div><!-- /.row -->
<br>


<div id="rowGrilla">
        <tr>
            <td><input type="text" name="producto_id1[]" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="cantidad1[]" aria-describedby="basic-addon1"></td>
            <td>

                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}

            </td>
        </tr>
</div>

<table class="table table-striped" id="grilla1">

        <tr>
            <th>Producto id</th>
            <th>Cantidad</th>
        </tr>
<!-- en duro para llenar uno por uno-->
En duro para llenar uno por uno

        <tr>
            <td><input type="text" name="producto_id1[]" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="cantidad1[]" aria-describedby="basic-addon1"></td>
            <td>

                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}

            </td>
        </tr>

        <tr>
            <td><input type="text" name="producto_id1[]" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="cantidad1[]" aria-describedby="basic-addon1"></td>
            <td>

                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}

            </td>
        </tr>

</table>

    <div class="col-lg-4">
      {{ Form::submit('Ingresar mercaderías y generar Códigos', array('class' => 'btn btn-lg btn-primary')) }}
    </div>
 
<br>
<br>
<br>
<br>

<script>

function agrega(){

alert(1)

}
</script>

</form>

@stop


