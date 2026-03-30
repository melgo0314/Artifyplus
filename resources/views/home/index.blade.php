<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    
@extends('layouts.app')

@section('container-class', '')

@section('content')

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: radial-gradient(circle at bottom, #8e2de2, #0a0a0a 70%);
    color: white;
}

/* CONTENEDOR PRINCIPAL */
.main-container {
    width: 90%;
    max-width: 1100px;
    margin: 40px auto;
    padding: 30px;
    border-radius: 20px;

    background: rgba(20, 20, 30, 0.7);
    backdrop-filter: blur(15px);

    box-shadow:
        0 0 40px rgba(128,0,255,0.4);
}

/* BUSCADOR */
.search-bar {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: none;
    background: rgba(255,255,255,0.1);
    color: white;
    margin-bottom: 20px;
}

/* TITULO */
h2 {
    margin-bottom: 5px;
}

.subtitle {
    color: #aaa;
    margin-bottom: 20px;
}

/* GRID */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

/* CARD */
.card {
    background: linear-gradient(135deg, #6a00f4, #8e2de2);
    border-radius: 15px;
    padding: 20px;
    position: relative;
    transition: 0.3s;
    cursor: pointer;
}

.card:hover {
    transform: translateY(-5px) scale(1.03);
    box-shadow: 0 0 20px #bb00ff;
}

/* PERFIL */
.card-header {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.card-header img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

/* ESTRELLA */
.star {
    position: absolute;
    top: 10px;
    right: 10px;
    color: gold;
}

/* TEXTO */
.card p {
    font-size: 13px;
    color: #ddd;
}

.navbar-top {
    display: flex;
    justify-content: space-between;
    margin: auto;
}

.btn-logout {
    background: linear-gradient(90deg, #ff0040, #ff4d6d);
    border: none;
    padding: 8px 15px;
    border-radius: 8px;
    color: white;
    cursor: pointer;
    transition: 0.3s;
}

.btn-logout:hover {
    transform: scale(1.05);
    box-shadow: 0 0 10px #ff4d6d;
}

/* BOTÓN SUSCRIBIR */
.btn-subscribe {
    width: 100%;
    margin-top: 10px;
    padding: 10px;

    border: none;
    border-radius: 10px;

    background: linear-gradient(90deg, #8000ff, #bb00ff);
    color: white;
    font-weight: bold;
    font-size: 14px;

    cursor: pointer;
    transition: 0.3s;
}

/* HOVER */
.btn-subscribe:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px #bb00ff;
}

/* CLICK */
.btn-subscribe:active {
    transform: scale(0.97);
}

.btn-subscribed {
    width: 100%;
    margin-top: 10px;
    padding: 10px;

    border-radius: 10px;
    border: 1px solid #bb00ff;

    background: transparent;
    color: #bb00ff;
    font-weight: bold;
}
.btn-watch {
    display: block;
    width: 40%;
    margin-top: 10px;
    padding: 10px;

    border-radius: 10px;
    text-align: center;

    background: rgba(255,255,255,0.05);
    border: 1px solid #bb00ff;

    color: #dc96f5;
    font-weight: bold;
    text-decoration: none;

    transition: 0.3s;
}

.btn-watch:hover {
    background: linear-gradient(90deg, #8000ff, #bb00ff);
    color: white;
    box-shadow: 0 0 15px #bb00ff;
}
</style>


<div class="main-container">

    <h2>Música</h2>
    <div class="subtitle">Lo más popular <i class="fa-solid fa-chart-line"></i></div>
    
    <div class="logut-container">
        <form action="{{ route('cerrar') }}" method="POST">
            @csrf
            <button class="btn-logout">Cerrar sesión</button>
        </form>
    </div>
    <br>

    <div class="grid">

    @foreach($channels as $channel)
        <div class="card">

            <div class="card-header">
                <strong>{{ $channel->name }}</strong>
            </div>

            <p>{{ $channel->description }}</p>

            @if(auth()->user()->channels->contains($channel->id))               
                <a href="#" class="btn-watch">
                    Ver más  <i class="fa-solid fa-caret-right"></i>
                </a>
            @else
                <form action="{{ route('subscribe', $channel->id) }}" method="POST">
                    @csrf
                    <button class="btn-subscribe">Suscribirme</button>
                </form>
            @endif
        </div>
    @endforeach
    </div>
</div>
@endsection
</body>
</html>