@extends('layouts.scaffold')
@section('main')

<script>


    $(function() {
        $( "#datepicker1" ).datepicker({
            defaultDate: "-2w",
            changeMonth: true,
            numberOfMonths: 2,
            dateFormat: 'yy/mm/dd',
            onSelect: function( selectedDate ) {
                $( "#datepicker2" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#datepicker2" ).datepicker({
            defaultDate: "0",
            changeMonth: true,
            numberOfMonths: 2,
            dateFormat: 'yy/mm/dd',
            onClose: function( selectedDate ) {
                $( "#datepicker1" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    });
</script>


<script type="text/javascript">
$(document).ready(function(){
  $("#consultabutton").click(function(){

    if( $( "#datepicker1" ).val() =="" )    //valida campo 
    {
        alert("Ingrese fecha")
        return false
    }
    if( $( "#tipomovimiento_id" ).val() == 0 )    //valida campo 
    {
        alert("Ingrese el tipo de movimiento")
        return false
    }

    $(this).hide();
    $("#muestramsg").show();
    return true;});
 });
</script>



<h3>Descarga Excel de Guías y Cuadernos (Kardex LaQuinta.xls)</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </ul>
    </div>
@endif
<br>
<br>
<form method="POST" action="{{url('guiacuaderno-descargar')}}">
<div class="row">


        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon">Fecha Inicio</span>
                <input type="text" id="datepicker1" name="fecini" class="form-control" Input::get('fecini') aria-describedby="basic-addon1" required>
            </div>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-1">
        </div>
        <div class="col-lg-3">
            <div class="input-group">
                <span class="input-group-addon">Fecha Fin</span>
                <input type="text" id="datepicker2" name="fecfin" class="form-control" value={{date("Y/m/d")}} aria-describedby="basic-addon1" required>
            </div>
        </div><!-- /.col-lg-6 -->


        <br>
</div>  

<br>

<div class="row">
        <div class="col-lg-3">
        </div><!-- /.col-lg-6 -->
</div>  
<br>
<div class="row">
    <div class="col-lg-10">
    </div>
    <div class="col-lg-2">
                <button type="submit" class="btn btn-info">Descargar Guías y Cuadernos</button>
    </div><!-- /.col-lg-6 -->     
</div> 
</form>
@stop
