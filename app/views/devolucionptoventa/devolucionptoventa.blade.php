@extends('layouts.scaffold')

@section('main')

<script src="../lib/jquery.js"></script>
<script src="../dist/jquery.validate.js"></script>
<script>
  // only for demo purposes
  $.validator.setDefaults({
    submitHandler: function() {
      alert("submitted!");
    }
  });

  $(document).ready(function() {
    $("#validadorjs").validate();
  });
</script>

<form id="validadorjs" method="POST">

<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Devolución de mercadería de un Punto de Venta a Almacén</h3>

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
                <span class="input-group-addon" id="marca_id">Vendedor</span>
                {{Form::select('usuario_id', [''=>'Seleccione'] + DB::table('users')->where('rolusuario',"VENDE")->orderby('desusuario')->lists('desusuario','id'),null,array('class'=>'form-control', 'required'=>'required'))}}
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="localini">Local Inicial</span>
                {{Form::select('localini',[''=>'Seleccione'] + DB::table('locals')->where('deslocal','<>','ALMACEN')->orderby('deslocal')->lists('deslocal','id'),null,array('class'=>'form-control', 'required'=>'required'))}}
           </div>
        </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<br>
<div class="row">

        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="localfin">Motivo devolución</span>
                {{Form::select('localfin',['ACT'=>'Activo', 'INA'=>'Inactivo', 'DEV'=>'Devolución', 'BAJ'=>'Baja'] ,null,array('class'=>'form-control', 'required'=>'required'))}}
           </div>
        </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<br>
<br>
<div class="row">
    <div class="col-lg-5">
        <div class="input-group">
            <span class="input-group-addon" id="mercaderia_id">Mercadería</span>
            <input type="text" class="form-control" placeholder="Necesario #de merca en guia de traslado" aria-describedby="basic-addon1">
       </div>
    </div><!-- /.col-lg-6 -->  
    [Aparece codproducto31]  
</div><!-- /.row -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>Mercadería</th>
            <th>codproducto31</th>
    </thead>
<!-- en duro para llenar uno por uno-->
    <tbody>
        <tr>
            <td><input type="text" name="mercaderia_id1"></td>
            <td><input type="text" name="codproducto311" aria-describedby="basic-addon1"></td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id2" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="codproducto312" aria-describedby="basic-addon1"></td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id3" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="codproducto313" aria-describedby="basic-addon1"></td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id4" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="codproducto314" aria-describedby="basic-addon1"></td>
            <td>
                {{ Form::open() }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
        <tr>
            <td><input type="text" name="mercaderia_id5" aria-describedby="basic-addon1"></td>
            <td><input type="text" name="codproducto315" aria-describedby="basic-addon1"></td>
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


