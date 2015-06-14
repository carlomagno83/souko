@extends('layouts.scaffold')

@section('main')

<form method="POST">

<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Liquidación de la Guía de devolución</h3>

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
<!-- llenando la tabla -->
<br>
<div class="row">
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="documento_id">Documento (Guía de devolución)</span>
            <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
       </div>
    </div><!-- /.col-lg-6 -->  
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
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id2" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="codproducto312" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="precio2"></td>
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id3" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="codproducto313" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="precio3"></td>
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id4" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="codproducto314" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="precio4"></td>
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id5" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="codproducto315" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="precio5"></td>
        </tr>
    </tbody>
</table>

    <div class="col-lg-4">
      {{ Form::submit('Liquidar Guía', array('class' => 'btn btn-lg btn-primary')) }}
    </div>
{{ Form::close() }}    
<br>
<br>
<br>
<br>



@stop


