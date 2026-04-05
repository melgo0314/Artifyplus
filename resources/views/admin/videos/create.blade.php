<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Videos</title>
      @extends('layouts.app')

    @section('container-class', '')

    @section('content')
<style>
body{
    background: radial-gradient(circle at top, #1a0b2e, #0a0a14);
    color: white;
    font-family: 'Segoe UI', sans-serif;
}

/* CONTENEDOR */
.container{
    max-width: 600px;
    margin: auto;
    padding: 30px;
    border-radius: 20px;
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(10px);
    box-shadow: 0 0 30px rgba(168,85,247,0.2);
}

/* TITULO */
h2{
    text-align: center;
    margin-bottom: 20px;
    color: #c084fc;
}

/* INPUTS */
input, textarea, select{
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 10px;
    border: 1px solid #8000ff;
    background: rgba(255,255,255,0.05);
    color: white;
    outline: none;
}

input:focus, textarea:focus, select:focus{
    box-shadow: 0 0 10px #a855f7;
}

/* BOTÓN */
.btn-save{
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    background: linear-gradient(135deg, #9333ea, #6d28d9);
    border: none;
    border-radius: 10px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.btn-save:hover{
    transform: scale(1.05);
    box-shadow: 0 0 15px #a855f7;
}

/* BOTÓN REGRESAR */
.btn-back{
    display: block;
    text-align: center;
    margin-top: 15px;
    color: #a855f7;
    text-decoration: none;
}

.btn-back:hover{
    text-decoration: underline;
}
</style>
</head>
    <body>
    <div class="container">

        <h2>Crear Video</h2>

        @include('partials.alerts')

        <form action="{{ route('admin.videos.store') }}" method="POST">
            @csrf

            <input type="text" name="title" placeholder="Título del video" required>

            <textarea name="description" placeholder="Descripción"></textarea>

            <input type="text" name="url" placeholder="URL del video (YouTube)" required>

            <select name="channel_id" required>
                <option value="">Selecciona un canal</option>
                @foreach($channels as $channel)
                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                @endforeach
            </select>

            <button class="btn-save">Guardar Video</button>
        </form>

        <a href="{{ route('admin.dashboard') }}" class="btn-back">
            ← Volver
        </a>

    </div>

    @endsection
</body>
</html>