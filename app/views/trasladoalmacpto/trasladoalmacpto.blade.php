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



<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Traslado de mercadería a Pto de Venta desde Almacén</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>


<form id="validadorjs" method="POST" action="{{url('trasladoalmacpto-store')}}">


<div class="row">
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="usuario_id">Vendedor</span>
                {{Form::select('usuario_id', [''=>''] + DB::table('users')->where('rolusuario',"VENDE")->orderby('desusuario')->lists('desusuario','id'),null, array('class'=>'form-control', 'required'=>'required'))}}
            </div>
        </div><!-- /.col-lg-6 -->

        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="local_id">Local</span>
                {{Form::select('local_id',[''=>''] + DB::table('locals')->where('deslocal','<>','ALMACEN')->orderby('deslocal')->lists('deslocal','id'), null ,array('class'=>'form-control', 'required'=>'required'))}}
           </div>
        </div><!-- /.col-lg-6 -->
</div>  




<!-- llenando la tabla -->
<br>
<div class="row">
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="mercaderia_id">Mercadería</span>
            <input type="text" class="form-control" placeholder="Uso de pistola" aria-describedby="basic-addon1">
       </div>
    </div><!-- /.col-lg-6 --> 
  <!-- Botón para agregar filas -->
    <input type="button"  value="Agregar Registro" onclick="agregareg(mercaderia_id)" class="btn btn-primary" > 
</div><!-- /.row -->
<br>
<br>
<br>
<br>
<br>

  <div class="col-lg-4">
    {{ Form::submit('Finalizar', array('class' => 'btn btn-lg btn-primary')) }}
  </div>
</form>   

 <br>
 <br>
 <br>



@stop


