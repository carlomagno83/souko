<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authenticate with Laravel 4.2</title>
</head>
<body>
    <div class="container">
        {{ Form::open(['url' => 'login']) }}
 
            @if(Session::has('error_message'))
                {{ Session::get('error_message') }}
            @endif
 
            <h2>Ingreso al sistema</h2>
 
            {{ Form::label('username', 'Usuario') }}
            {{ Form::text('username') }}
 
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password') }}
 
            <label>
                {{ Form::checkbox('remember', true) }} Remember me
            </label>
            
            {{ Form::submit('Log in', ['class' => 'btn btn-primary btn-block']) }}
    
        {{ Form::close() }}
    </div>
</body>
</html>