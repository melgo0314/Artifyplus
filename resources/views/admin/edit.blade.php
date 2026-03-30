<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @extends('layouts.app')

@section('container-class', '')

@section('content')

<style>
body {
    background: #0a0a0a;
    color: white;
}

/* CONTENEDOR */
.form-container {
    max-width: 500px;
    margin: 50px auto;
    padding: 30px;
    border-radius: 15px;

    background: rgba(20, 20, 30, 0.85);
    backdrop-filter: blur(10px);

    box-shadow: 
        0 0 25px rgba(128,0,255,0.6),
        0 0 50px rgba(128,0,255,0.2);
}

/* TITULO */
.form-container h2 {
    margin-bottom: 15px;
}

/* INPUTS */
.input-group {
    margin: 15px 0;
}

.input-group label {
    display: block;
    margin-bottom: 6px;
    color: #bbb;
}

.input-group input,
.input-group textarea {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #8000ff;
    background: rgba(255,255,255,0.05);
    color: white;
    outline: none;
    transition: 0.3s;
}

.input-group input:focus,
.input-group textarea:focus {
    border-color: #bb00ff;
    box-shadow: 0 0 10px #bb00ff;
}

/* BOTÓN ACTUALIZAR */
.btn-purple {
    width: 100%;
    padding: 12px;
    background: linear-gradient(90deg, #8000ff, #bb00ff);
    border: none;
    border-radius: 10px;
    color: white;
    font-weight: bold;
    transition: 0.3s;
}

.btn-purple:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px #bb00ff;
}

/* BOTÓN VOLVER */
.btn-back {
    display: block;
    margin-top: 12px;
    text-align: center;

    padding: 10px;
    border-radius: 10px;

    background: transparent;
    border: 1px solid #8000ff;

    color: #bb00ff;
    text-decoration: none;
    font-weight: bold;

    transition: 0.3s;
}

.btn-back:hover {
    background: linear-gradient(90deg, #8000ff, #bb00ff);
    color: white;
    box-shadow: 0 0 12px #bb00ff;
    transform: scale(1.03);
}
</style>
</head>
<body>
    <div class="form-container">

        <h2>Editar Canal</h2>

        @include('partials.alerts')

        <form action="{{ route('admin.update', $channel->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="input-group">
                <label>Nombre</label>
                <input type="text" name="name" value="{{ $channel->name }}">
            </div>

            <div class="input-group">
                <label>Descripción</label>
                <textarea name="description">{{ $channel->description }}</textarea>
            </div>

            <button class="btn-purple">Actualizar</button>
        </form>

       <form action="{{ route('admin.dashboard') }}" method="GET">
             @csrf
            <button class="btn-back"><i class="fa-solid fa-circle-arrow-left"></i> Volver</button>
        </form>

    </div>

    @endsection
    
</body>
</html>