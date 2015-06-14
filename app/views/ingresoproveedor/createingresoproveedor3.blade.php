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



<div class="row">

    <div class="col-lg-3">
        <div class="input-group">
            <span class="input-group-addon" id="tipomovimiento_id">Tipo de movimiento</span>
            <input type="text" placeholder="id" aria-describedby="basic-addon1">
        </div>
    </div><!-- /.col-lg-6 -->
    

<!-- /.row -->
<!-- llenando la tabla -->

    <div class="col-lg-3">
      {{ Form::submit('graba', array('class' => 'btn btn-lg btn-primary')) }}

    </div>
</div>
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


