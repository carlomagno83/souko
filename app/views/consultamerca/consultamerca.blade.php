@extends('layouts.scaffold')
@section('main')




<h3>Consulta de Mercadería</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </ul>
        </div>
    @endif
<br>
<form method="POST" id="validadorjs" action="{{url('consultamercaderia')}}">
<div class="row">
    <div class="col-lg-5">
        <div class="input-group">
            <span class="input-group-addon">Número de mercadería a consultar</span>
            <input type="text" id="nummerca" name="nummerca" class="form-control" aria-describedby="basic-addon1">
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




@stop
