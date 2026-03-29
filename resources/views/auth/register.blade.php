<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')

    <h1>REGISTRO</h1>
    <form action="{{route('registro.store')}}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nombre" class="form-control">
        <br>
        <input type="email" name="email" placeholder="Email" class="form-control">
        <br>
        <input type="text" name="phone" placeholder="Telefono" class="form-control">
        <br>
        <input type="password" name="password" placeholder="Password" class="form-control">
        <br>
        <input type="password" name="password_confirmation" placeholder="Confirmar Password" class="form-control">
        <br>
        <button type="submit" class="btn btn-pimary">Guardar</button>

    </form>

    @endsection
</body>
</html>
