<html>
<head>
<body>


<table>

<tbody>
@foreach( $mercaderias as $key=>$value)
    <tr> 
        <td> {{$value->id}}</td> 
        <td> {{$value->codproducto31}}</td> 
    </tr>
@endforeach
</tbody>
</table>
</div>

</body>
</html>
