@extends('layouts.scaffold')

@section('main')

<script src="../lib/jquery.js"></script>
<script src="../dist/jquery.validate.js"></script>

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
            <th width="15%"># Documento</th>
            <th></th>
            <th width="25%">Movimiento</th>             
            <th width="25%">Local</th>
            <th width="15%">Fecha creación doc</th>
            <th width="20%">Fecha sistema</th>


        </tr>    
    </thead>


        @foreach ($mercaderias as $mercaderia)
        <tr>
            <td width="15%"><input type="text" name="id[]" id="id[]" value="{{$mercaderia->Numdoc}}" class="form-control" readonly tabindex="-1"></td>
            <td><input style="visibility:hidden;" type="text"  name="codproducto31[]" value="{{$mercaderia->tipomovimiento_id}}" readonly class="form-control" tabindex="-1"></td>
            <td width="25%"><input type="text"  value="{{$mercaderia->destipomovimiento}}" readonly class="form-control" tabindex="-1"></td>
            <td width="25%"><input type="text"  value="{{$mercaderia->deslocal}}" readonly class="form-control" tabindex="-1"></td>
            <td width="15%"><input type="text"  value="{{$mercaderia->fechadocumento}}" readonly class="form-control" tabindex="-1"></td>
            <td width="20%"><input type="text"  value="{{$mercaderia->created_at}}" readonly class="form-control" tabindex="-1"></td>
        </tr>
        @endforeach
</table>


@stop


