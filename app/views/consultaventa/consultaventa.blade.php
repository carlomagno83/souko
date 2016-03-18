@extends('layouts.scaffold')

@section('main')

<script>
$().ready(function() {
    $("form").validate({
        rules: {
            #mes: {
                required:true,
            }
            #anho: {
                required:true,
                min: 2015,
                max: 2050,
                numeric:true
            }           
        },
        messages: {
        }
    });
});
</script>

<h3>Consulta de Ventas por vendedor</h3>
        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
          </div>
        @endif
<br>
<form method="POST" id="validadorjs" action="{{url('consultaventabuscar')}}">
<div class="row">
      <div class="col-sm-3">
          <div class="input-group">      
            <span class="input-group-addon" >Mes</span>
              <select name="mes" id="mes" class="form-control" Input::get('mes') required tabindex='-1'>
                  <option value="">Escoja mes</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                </select>
          </div>
      </div>
      <div class="col-lg-3">
          <div class="input-group">
              <span class="input-group-addon">Año</span>
              <input type="text" id="anho" name="anho" value={{date("Y")}} Input::get('anho') class="form-control" aria-describedby="basic-addon1">
          </div>
      </div><!-- /.col-lg-6 -->

    <div class="col-lg-3">
        {{ Form::submit('Consultar', array('class' => 'btn btn-info')) }}
        
    </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
</form>
<br>
<br>
<br>


@if (count($resultados)>0)
<div class="jumbotron">
<table class="table table-striped">
    <thead>
        <tr>
            <th width="25%">Nombre Vendedor</th>
            <th width="20%">Items vendidos {{Input::get('anho')}} / {{Input::get('mes')}}</th>
            <th></th>

        </tr>    
    </thead>


    @foreach( $resultados as $key=>$value)
        <tr> 
            <td>{{$value->desusuario}} </td> 
            <td>{{$value->total_items}}</td>
        
        </tr>
    @endforeach

   
</table>
</div>
@endif


@stop
