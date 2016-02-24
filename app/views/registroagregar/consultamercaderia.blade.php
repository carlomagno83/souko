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


<table class="table table-striped">
    <thead>
        <tr>
            <th width="10%"># Documento</th>
            <th width="5%">T. Mov.</th>
            <th width="20%">Movimiento</th>             
            <th width="15%">Local</th>
            <th width="10%">Fecha creación doc</th>


        </tr>    
    </thead>


        @foreach ($mercaderias as $mercaderia)
        <tr>
            <td width="10%"><input type="text" name="id[]" id="id[]" value="{{$mercaderia->Numdoc}}" class="form-control" readonly tabindex="-1"></td>
            <td width="5%"><input type="text"  name="codproducto31[]" value="{{$mercaderia->tipomovimiento_id}}" readonly class="form-control" tabindex="-1"></td>
            <td width="20%"><input type="text"  value="{{$mercaderia->destipomovimiento}}" readonly class="form-control" tabindex="-1"></td>
            <td width="15%"><input type="text"  value="{{$mercaderia->deslocal}}" readonly class="form-control" tabindex="-1"></td>
            <td width="10%"><input type="text"  value="{{$mercaderia->fechadocumento}}" readonly class="form-control" tabindex="-1"></td>
        </tr>
        @endforeach
</table>


@stop


