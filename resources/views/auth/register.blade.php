<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
<style>
body {
    background: radial-gradient(circle at top, #2b0050, #0a0a0a 70%);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Contenedor */
.login-container {
    width: 350px;
    padding: 30px;
    border-radius: 18px;
    
    background: rgba(10, 10, 10, 0.85);
    
    /*glow morado */
    box-shadow: 
        0 0 25px rgba(128, 0, 255, 0.6),
        0 0 50px rgba(128, 0, 255, 0.2);

    backdrop-filter: blur(10px);
    text-align: center;
}

/* Inputs */
.login-container input {
    width: 100%;
    padding: 12px;
    margin: 12px 0;
    border-radius: 10px;
    
    border: 1px solid #8000ff;
    background: rgba(255, 255, 255, 0.05);
    
    color: white;
    outline: none;
    transition: 0.3s;
}

.login-container input:focus {
    border-color: #bb00ff;
    box-shadow: 0 0 10px #bb00ff;
}

/* Botón */
.login-container button {
    width: 100%;
    padding: 12px;
    background: linear-gradient(90deg, #8000ff, #bb00ff);
    border: none;
    border-radius: 10px;
    color: white;
    font-weight: bold;
    transition: 0.3s;
}

.login-container button:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px #bb00ff;
}

/* Logo */
.logo {
    font-size: 30px;
    font-weight: bold;
    color: #fff;
}

.logo span {
    color: #bb00ff;
}

/* Título */
h2 {
    color: #fff;
}


body::before {
    content: "";
    position: absolute;
    width: 500px;
    height: 500px;
    background: radial-gradient(rgba(128,0,255,0.4), transparent 70%);
    filter: blur(80px);
    z-index: -1;
}

/* Grupo input + icono */
.input-group {
    position: relative;
    margin: 15px 0;
}

/* Icono dentro */
.input-group i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #bb00ff;
    font-size: 14px;
}

/* Input con espacio para icono */
.input-group input {
    width: 100%;
    margin: 3px 0;
    padding: 12px 12px 12px 35px; /* 👈 espacio izquierda */
    border-radius: 10px;
    border: 1px solid #8000ff;
    background: rgba(255, 255, 255, 0.05);
    color: white;
    outline: none;
}

/* Focus */
.input-group input:focus {
    border-color: #bb00ff;
    box-shadow: 0 0 10px #bb00ff;
}


.input-group i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #bb00ff;
    font-size: 14px;
}

.input-group input {
    width: 100%;
    padding: 12px 12px 12px 35px;
    border-radius: 10px;
    border: 1px solid #8000ff;
    background: rgba(255, 255, 255, 0.05);
    color: white;
    outline: none;
}

.input-group input:focus {
    border-color: #bb00ff;
    box-shadow: 0 0 10px #bb00ff;
}
</style>
</head>
<body>
   @extends('layouts.app')

@section('container-class', '')

@section('content')

<div class="login-container">
    <div class="logo">Artify<span>Plus</span></div>

    <h2>Registro</h2>
     @include('partials.alerts')

    <form action="{{ route('registro.store') }}" method="POST">
        @csrf

        <div class="input-group">
            <i class="fa-solid fa-user"></i>
            <input type="text" name="name" placeholder="Nombre">
        </div>

        <div class="input-group">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" name="email" placeholder="Email">
        </div>

        <div class="input-group">
            <i class="fa-solid fa-phone"></i>
            <input type="text" name="phone" placeholder="Teléfono">
        </div>

        <div class="input-group">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="Password">
        </div>

        <div class="input-group">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password_confirmation" placeholder="Confirmar Password">
        </div>

        <button type="submit">Registrarse</button>
    </form>

        <p>¿Ya tienes cuenta? 
            <a href="{{ route('acceso') }}">Inicia sesión</a>
        </p>
</div>
    @endsection
</body>
</html>
