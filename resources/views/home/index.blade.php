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
</style>

<div class="main-container">
    <input type="text" class="search-bar" placeholder="Buscar contenido...">
    <div class="logut-container">
        <form action="{{ route('cerrar') }}" method="POST">
            @csrf
            <button class="btn-logout">Cerrar sesión</button>
        </form>
    </div>


    <h2>Música</h2>
    <div class="subtitle">Lo más popular <i class="fa-solid fa-chart-line"></i></div>
    

    <div class="grid">

        <!-- CARD -->
        <div class="card">
            <div class="star">★</div>
            <div class="card-header">
                <strong>Natanael Cano</strong>
            </div>
            <p>Contenido exclusivo: videos, música y lanzamientos especiales.</p>
        </div>

        <div class="card">
            <div class="star">★</div>
            <div class="card-header">
                <strong>La Obsesion</strong>
            </div>
            <p>Contenido exclusivo: videos, música y lanzamientos especiales.</p>
        </div>

        <div class="card">
            <div class="star">★</div>
            <div class="card-header">
                <strong>Bad Bunny</strong>
            </div>
            <p>Contenido exclusivo: videos, música y lanzamientos especiales.</p>
        </div>

        <div class="card">
            <div class="star">★</div>
            <div class="card-header">
                <strong>Alemán</strong>
            </div>
            <p>Contenido exclusivo: videos, música y lanzamientos especiales.</p>
        </div>

        <div class="card">
            <div class="star">★</div>
            <div class="card-header">
                <strong>Cachirula</strong>
            </div>
            <p>Contenido exclusivo: videos, música y lanzamientos especiales.</p>
        </div>

        <div class="card">
            <div class="star">★</div>
            <div class="card-header">
                <strong>Latin Mafia</strong>
            </div>
            <p>Contenido exclusivo: videos, música y lanzamientos especiales.</p>
        </div>

    </div>

</div>

@endsection
</body>
</html>