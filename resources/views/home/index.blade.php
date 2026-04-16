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
    font-family: 'Segoe UI', sans-serif;
    background: radial-gradient(circle at top, #1a0b2e, #0a0a14);
    color: white;
}

/* CONTENEDOR */
.main-container {
    width: 90%;
    max-width: 1100px;
    margin: 40px auto;
    padding: 30px;
    border-radius: 20px;

    background: rgba(20, 20, 30, 0.7);
    backdrop-filter: blur(15px);

    box-shadow: 0 0 40px rgba(128,0,255,0.3);
}

/* HEADER */
.top-bar{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

/* TITULO */
.title-box h2{
    margin: 0;
    font-size: 28px;
}

.subtitle{
    color: #aaa;
    font-size: 14px;
}

/* ACCIONES */
.actions-box{
    display: flex;
    align-items: center;
    gap: 10px;
}

/* BOTÓN SUSCRIPCIONES */
.btn-subscriptions{
    background: linear-gradient(135deg, #9333ea, #6d28d9);
    padding: 8px 14px;
    border-radius: 10px;
    color: white;
    text-decoration: none;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: 0.3s;
}

.btn-subscriptions:hover{
    transform: scale(1.05);
    box-shadow: 0 0 15px #a855f7;
}

/* LOGOUT */
.btn-logout{
    background: rgba(255,255,255,0.08);
    border: none;
    padding: 8px 12px;
    border-radius: 10px;
    color: #ff4d6d;
    cursor: pointer;
    transition: 0.3s;
}

.btn-logout:hover{
    background: rgba(255,77,109,0.2);
    box-shadow: 0 0 10px #ff4d6d;
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
    transition: 0.3s;
    position: relative;
}

.card:hover {
    transform: translateY(-5px) scale(1.03);
    box-shadow: 0 0 25px #bb00ff;
}

/* TITULO CARD */
.card strong{
    font-size: 18px;
}

/* TEXTO */
.card p {
    font-size: 13px;
    color: #eee;
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

    cursor: pointer;
    transition: 0.3s;
}

.btn-subscribe:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px #bb00ff;
}

/* BOTÓN VER */
.btn-watch {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 15px;

    border-radius: 10px;
    text-align: center;

    background: rgba(255,255,255,0.05);
    border: 1px solid #bb00ff;

    color: #e0aaff;
    font-weight: bold;
    text-decoration: none;

    transition: 0.3s;
}

.btn-watch:hover {
    background: linear-gradient(90deg, #8000ff, #bb00ff);
    color: white;
    box-shadow: 0 0 15px #bb00ff;
}

.btn-subscribe {
    display: block;
    width: 100%;
    padding: 14px;
    margin-top: 15px;

    background: #261141; 
    color: white;

    border-radius: 14px;
    font-weight: bold;
    text-align: center;
    text-decoration: none;

    border: none;

    transition: all 0.3s ease;
}

.btn-subscribe:hover {
    background: #9333ea;
    box-shadow: 0 0 20px rgba(147, 51, 234, 0.8);
    transform: translateY(-2px);
}

</style>
<body>
    
    <div class="main-container">

        <div class="top-bar">

            <div class="title-box">
                <h2>Música</h2>
                <div class="subtitle">
                    Lo más popular <i class="fa-solid fa-chart-line"></i>
                </div>
            </div>

            <div class="actions-box">

                <a href="{{ route('home.suscripciones') }}" class="btn-subscriptions">
                    <i class="fa-solid fa-credit-card"></i>
                    Suscripciones
                </a>

                <form action="{{ route('cerrar') }}" method="POST">
                    @csrf
                    <button class="btn-logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>

            </div>
        </div>

        <div class="grid">

        @foreach($channels as $channel)
            <div class="card">

                <strong>{{ $channel->name }}</strong>

                <p>{{ $channel->description }}</p>

                @if(auth()->user()->channels->contains($channel->id))               
                    <a href="{{ route('canal.videos', $channel->id) }}" class="btn-watch">
                        Ver más <i class="fa-solid fa-caret-right"></i>
                    </a>
                @else
                    <a href="{{ route('pagar', $channel->id) }}" class="btn-subscribe">
                        Suscribirse 
                    </a>
                @endif

            </div>
        @endforeach
        </div>
    </div>
    @endsection
</body>
</html>