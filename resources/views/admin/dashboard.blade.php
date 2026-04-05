<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
@extends('layouts.app')

@section('container-class', '')

@section('content')

<style>
body { background:#0a0a0a; color:white; }

/* SIDEBAR */
.sidebar {
    width:220px;
    height:100vh;
    position:fixed;
    background:#000;
    padding:20px;
}

.main {
    margin-left:220px;
    padding:30px;
}

.btn-purple {
    background:linear-gradient(90deg,#8000ff,#bb00ff);
    border:none;
    padding:8px 12px;
    border-radius:8px;
    color:white;
}

.btn-danger {
    background:linear-gradient(90deg,#ff0040,#ff4d6d);
    border:none;
    padding:8px 12px;
    border-radius:8px;
    color:white;
}

.grid {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
}

.card {
    background:linear-gradient(135deg,#1a0026,#2b0050);
    padding:20px;
    border-radius:15px;
    color: white;
}
</style>
</head>
<body>
   <div class="sidebar">
        <h2>Artify<span style="color:#bb00ff">Admin</span></h2>

        <a href="{{ route('admin.usuarios') }}">
           <button class="btn-purple">Gestionar Usuarios</button> 
        </a>

        <a href="{{ route('admin.videos.create') }}">
            <button class="btn-create">
                <i class="fa-solid fa-film"></i> Crear Video
            </button>
         </a>

        <br><br>
        <form action="{{ route('cerrar') }}" method="POST">
            @csrf
            <button class="btn-danger">Cerrar sesión</button>
        </form>
    </div>

    <div class="main">

        <div style="display:flex; justify-content:space-between;">
            <h1>Channels</h1>

            <form action="{{ route('admin.create') }}">
              @csrf    
            <button class="btn-purple"><i class="fa-solid fa-plus"></i>Crear Canal</button>
            </form>
        </div>
         @include('partials.alerts')

        <div class="grid">

            @foreach($channels as $channel)
            <div class="card">

                <h3>{{ $channel->name }}</h3>
                <p>{{ $channel->description }}</p>
                 
                <a href="{{ route('admin.edit',$channel->id) }}" >
                    <button class="btn-purple"><i class="fa-solid fa-pen-to-square"></i></button>
                </a>

                <form action="{{ route('admin.delete',$channel->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit"
                        class="btn-danger"
                        onclick="return confirm('Eliminar el registro?')">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>

            </div>
            @endforeach

        </div>

    </div>

    @endsection
</body>
</html>