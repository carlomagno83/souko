@extends('layouts.scaffold')

@section('main')

<script src="../lib/jquery.js"></script>
<script src="../dist/jquery.validate.js"></script>
<script>


  $(document).ready(function() {
    $("#validadorjs").validate();
  });
</script>

<script type="text/javascript">
$(document).ready(function(){
  $("#storebutton").click(function(){
    $(this).hide();
    $("#muestramsg").show();
    return true;});
 });
</script>


{{--<div align="right">--}}
    {{--<a id="home" href=" {{ URL::to('/') }} "><img src='img/home.ico' border='0'></a>--}}
{{--</div>--}}
<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Correcciones - Editar Guía de Ingreso (precio de Compra)</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

<form method="POST" id="validadorjs" action="{{url('ingresoeditar-buscar')}}">
<br>
<div class="row">
    <div class="col-lg-5">
        <div class="input-group">
            <span class="input-group-addon" id="documento_id"># Documento Ingreso (desde Proveedor)</span>
            <input type="text" name="documento_id" class="form-control" placeholder="" aria-describedby="basic-addon1" autofocus>
       </div>
    </div><!-- /.col-lg-6 -->  
</div><!-- /.row -->
<br>

<br>
    <input type="submit" value="Continuar" class=" btn btn-success">    
<br>
</form>




@stop


