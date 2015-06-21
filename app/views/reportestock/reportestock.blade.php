@extends('layouts.scaffold')

@section('main')

 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepicker1" ).datepicker();
  });  
  $(function() {
    $( "#datepicker2" ).datepicker();
  });
  </script>

<h3>Reporte de Stocks</h3>

<div class="row">
    <div class="col-lg-3">
        <div class="input-group">
            <span class="input-group-addon" id="documento_id">Fecha Inicio</span>
            <input type="text" id="datepicker1" name="fechaini" class="form-control" aria-describedby="basic-addon1">
        </div>
    </div><!-- /.col-lg-6 -->

     <div class="col-lg-3">
        <div class="input-group">
            <span class="input-group-addon" id="documento_id">Fecha Fin</span>
            <input type="text" id="datepicker2" name="fechafin" class="form-control" aria-describedby="basic-addon1">
        </div>
    </div><!-- /.col-lg-6 -->

    <div class="col-lg-3">
        {{ Form::submit('Filtrar por fechas', array('class' => 'btn btn-info')) }}
        
    </div><!-- /.col-lg-6 -->
</div><!-- /.row -->




@stop
