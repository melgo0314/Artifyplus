<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos</title>
    
<style>
body{
    background: radial-gradient(circle at top, #1a0b2e, #0a0a14);
    font-family: 'Segoe UI', sans-serif;
    color: white;
}

/* CONTENEDOR */
.container{
    max-width: 1100px;
    margin: auto;
    padding: 25px;
}

/* HEADER */
.header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    color: #fff;
    text-shadow: 0 0 10px rgba(168,85,247,0.6);
}

/* BOTÓN REGRESAR */
.btn-back{
    background: linear-gradient(135deg, #6b7280, #374151);
    padding: 8px 14px;
    border-radius: 10px;
    color: white;
    text-decoration: none;
    transition: 0.3s;
}

.btn-back:hover{
    transform: scale(1.05);
    box-shadow: 0 0 10px #a855f7;
}

/* GRID */
.videos-grid{
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

/* CARD */
.video-card{
    background: rgba(255,255,255,0.05);
    padding: 18px;
    border-radius: 18px;
    backdrop-filter: blur(10px);
    box-shadow: 0 0 20px rgba(168,85,247,0.15);
    transition: 0.3s;
}

.video-card:hover{
    transform: translateY(-5px);
    box-shadow: 0 0 25px rgba(168,85,247,0.4);
}

/* TITULO VIDEO */
.video-card h3{
    color: #a855f7;
    margin-bottom: 10px;
}

/* DESCRIPCIÓN */
.video-card p{
    font-size: 14px;
    color: #ccc;
}

/* BOTÓN VER */
.btn-ver{
    display: inline-block;
    margin-top: 12px;
    background: linear-gradient(135deg, #9333ea, #6d28d9);
    padding: 8px 14px;
    border-radius: 10px;
    color: white;
    text-decoration: none;
    transition: 0.3s;
}

.btn-ver:hover{
    transform: scale(1.05);
    box-shadow: 0 0 15px #a855f7;
}
</style>
</head>
<body>
    @extends('layouts.app')
    @section('content')
    @section('container-class', '')
  

    <div class="container">

        <div class="header">
            <h2>{{ $channel->name }}</h2>

            <a href="{{ route('home.index') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i>Regresar
            </a>
        </div>

        <div class="videos-grid">
            @foreach($channel->videos as $video)
                <div class="video-card">

                    <h3>{{ $video->title }}</h3>

                    <p>{{ $video->description }}</p>

                    <a href="{{ route('videos.show', $video->id) }}" class="btn-ver">
                        Ver video
                    </a>

                </div>
            @endforeach
        </div>

    </div>

    @endsection
</body>
</html>