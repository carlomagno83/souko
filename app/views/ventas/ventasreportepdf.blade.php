<html>
<head>

<style type="text/css">
.tftable {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
.tftable th {font-size:12px;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align:left;}
.tftable tr {background-color:#ffffff;}
.tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;}
</style>


</head>

<body>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h3>Embajador shoes</h3>
      	<h2>Reporte de Cierre de Ventas diarias por Tienda</h2>
        <div>Fecha : <input name="fecha" type="text" id="fecha" value={{date("d/m/Y")}} /></div>
        <div>Local : <input name="deslocal" type="text" id="deslocal" value="{{$deslocal}}" /></div>
        <div>Vendedor : <input name="desusuario" type="text" id="desusuario" value= "{{$desusuario}}" /></div>
        <br>
    		<table class="tftable" border="1">

          <thead>

            <tr> <th class="tg-031e">COD</th> <th>DESCRIPCION </th> <th>PRECIO </th>  </tr>
          
          </thead> 

          <tbody>
              @foreach( $mercaderias as $key=>$value)
              <tr> <td> {{$value->mercaderia_id}} </td> <td> {{$value->codproducto31}}</td> <td> {{$value->precioventa}}</td> </tr>
              @endforeach

          </tbody>


    		</table>
        <br>
        <div>Total de Items : <input name="total" type="text" id="total" value= "{{$total}}" /></div>

      </div>

    </div> <!-- /container -->


</body>
</html>



