<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <h1>DASHBOARD ADMIN</h1>
    
     <form action="{{route('cerrar')}}" method="POST">
            @csrf

            <button class="btn btn-danger">Cerrar Sesion</button>
        </form>


    @endsection
</body>
</html>