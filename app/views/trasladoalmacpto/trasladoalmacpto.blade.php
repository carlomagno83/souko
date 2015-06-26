@extends('layouts.scaffold')

@section('main')


<script type="text/javascript">

function agregareg($mercaderia_id) {
  
  var producto = document.getElementById("productoId").value;
  var cantidad = document.getElementById("cantidad").value;
  var nuevoElemento = "<li>" + "pone cualquier cosa"  + "</li>"; 
  
 
  lista.innerHTML = lista.innerHTML + nuevoElemento;
    
}
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


<form method="POST" action="{{url('trasladoalmacpto-store')}}">
<div class="row">
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="usuario_id">Vendedor</span>
                {{Form::select('usuario_id', [0=>'Seleccione'] + DB::table('users')->where('rolusuario',"VENDE")->orderby('desusuario')->lists('desusuario','id'),null,array('class'=>'form-control'))}}
            </div>
        </div><!-- /.col-lg-6 -->

        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon" id="local_id">Local</span>
                {{Form::select('local_id',[0=>'Seleccione'] + DB::table('locals')->where('deslocal','<>','ALMACEN')->orderby('deslocal')->lists('deslocal','id'),null,array('class'=>'form-control'))}}
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
    <input type="button" value="Agregar Registro" onclick="agregareg(mercaderia_id)" class="btn btn-info"> 
</div><!-- /.row -->
<br>
<br>

  <br>
  <br>
  <label for="Codigo producto">Codigo de Producto:</label>
  <input type="text" id="productoId" name="productoId" /><br/>
 
  <label for="Cantidad"> Cantidad:</label>
  <input type="text" id="cantidad" name="cantidad" /><br/>  

<br>
<br>
<br>
<br>

  <ul id="lista">
  </ul>
  <div class="col-lg-4">
    {{ Form::submit('Finalizar', array('class' => 'btn btn-lg btn-primary')) }}
  </div>
</form>   


 <br>
 <br>
 <br>



@stop


