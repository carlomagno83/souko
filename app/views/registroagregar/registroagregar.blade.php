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

<script type="text/javascript">
$(document).ready(function(){
  $("#storebutton").click(function(){
    $(this).hide();
    $("#muestramsg").show();
    return true;});
 });
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
$(function() {
$( "#datepicker1" ).datepicker();
$( "#datepicker1" ).datepicker("setDate","0" );
$( "#datepicker1" ).datepicker('option', {dateFormat: 'yy/mm/dd'});
});  
</script>

{{--<div align="right">--}}
    {{--<a id="home" href=" {{ URL::to('/') }} "><img src='img/home.ico' border='0'></a>--}}
{{--</div>--}}
<div class="row">
    <div class="col-md-0 col-md-offset-0">
        <h3>Correcciones - Agregar registro</h3>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

<form method="POST" id="validadorjs" action="{{url('agregaregistro-buscar')}}">
<br>
<div class="row">
    <div class="col-lg-3">
        <div class="input-group">
            <span class="input-group-addon" id="documento_id"># Documento</span>
            <input type="text" name="documento_id" class="form-control" placeholder="" aria-describedby="basic-addon1" autofocus>
       </div>
    </div><!-- /.col-lg-6 -->  
    <div class="col-lg-5">
        <div class="input-group">
            <span class="input-group-addon" id="tipomovimiento_id">Tipo de movimiento</span>
            {{Form::select('tipomovimiento_id',[''=>'', '2'=>'TRASLADO ALMAC A PTO', '4'=>'TRASLADO PTO A PTO', '3'=>'VENTA'] ,null,array('class'=>'form-control', 'required'=>'required'))}} <!-- cambio para escoger motivo -->
       </div>
    </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<br>
<div class="row">
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-addon" id="mercaderia_id"># de Mercadería</span>
            <input type="text" name="mercaderia_id" class="form-control" placeholder="" aria-describedby="basic-addon1" autofocus>
       </div>
    </div><!-- /.col-lg-6 -->  
</div><!-- /.row -->
<br>
    <input type="submit" value="Continuar" class=" btn btn-success">    
<br>
</form>




@stop


