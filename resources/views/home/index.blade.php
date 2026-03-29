<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    
    @extends('layouts.app')

    @section('content')

    <h1>Hola {{ auth()->user()->name }} Bienvenid@ a ARTIFY+  </h1>

    <form action="{{ route('suscribirse') }}" method="POST">
        @csrf
        <button class="btn btn-primary">Suscribirme</button>
    </form>

    @include('partials.alerts')

    <form action="{{route('cerrar')}}" method="POST">
            @csrf

            <button class="btn btn-danger">Cerrar Sesion</button>
        </form>

        
      @endsection
</body>
</html>