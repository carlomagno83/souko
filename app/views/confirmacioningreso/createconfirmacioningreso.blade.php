@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Confirmación de ingreso de mercadería a Almacén</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'movimientos.store', 'class' => 'form-horizontal')) }}


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
            <span class="input-group-addon" id="documento_id">Número de documento</span>
            <input type="text" class="form-control" placeholder="ingrese id documento" aria-describedby="basic-addon1">
        </div>
    </div><!-- /.col-lg-6 -->
    
    <div class="col-lg-4">
        {{ Form::submit('Borrar documento en caso de diferencia de cantidades', array('class' => 'btn btn-danger')) }}    
    </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<div class="row">
</div><!-- /.row -->
<br>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Mercadería id</th>
            <th>Descripción cod21</th>
    </thead>
<!-- en duro para llenar uno por uno-->
En duro para llenar uno por uno
    <tbody>
        <tr>
            <td><input type="text" name="mercaderia_id1"></td>
            <td><input type="text" name="codproducto21_1" aria-describedby="basic-addon1"></td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Marcar como defectuoso', array('class' => 'btn btn-info')) }}
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id2"></td>
            <td><input type="text" name="codproducto21_2" aria-describedby="basic-addon1"></td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Marcar como defectuoso', array('class' => 'btn btn-info')) }}
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id3"></td>
            <td><input type="text" name="codproducto21_3" aria-describedby="basic-addon1"></td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Marcar como defectuoso', array('class' => 'btn btn-info')) }}
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id4"></td>
            <td><input type="text" name="codproducto21_4" aria-describedby="basic-addon1"></td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Marcar como defectuoso', array('class' => 'btn btn-info')) }}
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id5"></td>
            <td><input type="text" name="codproducto21_5" aria-describedby="basic-addon1"></td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Marcar como defectuoso', array('class' => 'btn btn-info')) }}
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id6"></td>
            <td><input type="text" name="codproducto21_6" aria-describedby="basic-addon1"></td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Marcar como defectuoso', array('class' => 'btn btn-info')) }}
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id7"></td>
            <td><input type="text" name="codproducto21_7" aria-describedby="basic-addon1"></td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Marcar como defectuoso', array('class' => 'btn btn-info')) }}
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>        


    </tbody>
</table>

    <div class="col-lg-4">
      {{ Form::submit('Confirmación de mercaderías', array('class' => 'btn btn-lg btn-primary')) }}
    </div>
<br>
<br>
<br>
<br>

{{ Form::close() }}

@stop


