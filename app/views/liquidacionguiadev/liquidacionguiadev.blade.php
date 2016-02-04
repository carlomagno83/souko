@extends('layouts.scaffold')

@section('main')

<script type="text/javascript">
$(document).ready(function(){
  $("#storebutton").click(function(){
    $(this).val('Finalizado, haga click para continuar');
    $(this).addClass('btn btn-success');
    return true;});
});
</script>

<form method="POST" action="{{url('liquidacionguiadev-store')}}">
@if (count($documentos)>0)
<table class="table table-striped">
    <thead>
        <tr>
            <th width="15%">Proveedor</th>
            <th width="15%">Documento id</th>
            <th width="15%">Doc Físico</th>            
            <th>Fecha</th>
            <th width="10%">Monto</th>
            <th width="10%">Items</th>
            <th width="15%">Seleccione</th>
        </tr>    
    </thead>

        <?php $i=0 ?>
        @foreach ($documentos as $documento)
        <tr>
            <td width="15%"><input type="text" name="desprovider[]" id="desprovider[]" value="{{$documento->desprovider}}" class="form-control" tabindex="-1" readonly></td>
            <td width="15%"><input type="text" name="id[]" id="id[]" value="{{$documento->id}}" class="form-control" tabindex="-1" readonly></td>
            <td width="15%"><input type="text" name="numdocfisico[]" id="numdocfisico[]" value="{{$documento->numdocfisico}}" class="form-control" tabindex="-1" readonly></td>
            <td><input type="text" name="fechadocumento[]" value="{{$documento->fechadocumento}}" readonly class="form-control" tabindex="-1"></td>
            <td width="10%"><input type="text" name="totalcompra[]" value="{{$documento->totalcompra}}" readonly class="form-control" tabindex="-1"></td>
            <td width="10%"><input type="text" name="totalitem[]" value="{{$documento->totalitem}}" readonly class="form-control" tabindex="-1"></td>
            <td width="15%"><input type="checkbox" name="checkbox[{{$i}}]" class="form-control"/></td>
            <?php $i=$i+1 ?>
        </tr>
        @endforeach

</table>
<div class="row">
    <div class="col-lg-8">
    </div>
    <div class="col-lg-3">
        <input type="submit" value="Eliminar Guía de Devolución " class="btn btn-lg btn-primary">
    </div>
</div>  

<br><br>
@else

No hay Guías de Devolución para mostrar
</form>


@endif 

@if($errors->any())
<h2>{{$errors->first()}}</h2>
@endif 
@stop


