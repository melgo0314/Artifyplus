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
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #0a0a0a;
    color: white;
}

/* SIDEBAR */
.sidebar {
    width: 220px;
    height: 100vh;
    background: #000;
    border-right: 1px solid rgba(128,0,255,0.3);
    padding: 20px;
    position: fixed; 
    top: 0;
    left: 0;
}

.sidebar h2 span {
    color: #bb00ff;
}

.sidebar a {
    display: block;
    color: #aaa;
    text-decoration: none;
    margin: 10px 0;
}

.sidebar a:hover {
    color: #bb00ff;
}

/* MAIN */
.main {
    margin-left: 220px;
    padding: 30px;
}

/* HEADER */
.header {
    display: flex;
    align-items: center;
    gap: 20px;
}

/* BOTÓN LOGOUT */
.btn-logout {
    background: linear-gradient(90deg, #ff0040, #ff4d6d);
    border: none;
    padding: 10px 15px;
    border-radius: 8px;
    color: white;
}

/* CARDS */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.card {
    background: linear-gradient(135deg, #5a0283, #28014a);
    padding: 20px;
    border-radius: 15px;
    text-align: center;
}

/* TABLA */
.table {
    width: 100%;
    border-collapse: collapse;
    background: #111;
    border-radius: 10px;
    overflow: hidden;
}

.table th, .table td {
    padding: 12px;
    border-bottom: 1px solid #191818;
}

.table th {
    background: #40025c;
}
</style>
</head>
<body>
   
    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Artify<span>Admin</span></h2>

        <a href="#">Dashboard</a>
        <a href="#">Usuarios</a>
        <a href="#">Contenido</a>
        <a href="#">Suscripciones</a>
         <form action="{{ route('cerrar') }}" method="POST">
                @csrf
                <button class="btn-logout">Cerrar sesión</button>
            </form>
    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- HEADER -->
        <div class="header">
            <h1>Panel de Administración</h1>  
        </div>

        <!-- CARDS -->
        <div class="cards">
            <div class="card">
                <h3>Usuarios</h3>
                <p>120</p>
            </div>

            <div class="card">
                <h3>Suscriptores</h3>
                <p>45</p>
            </div>

            <div class="card">
                <h3>Videos</h3>
                <p>32</p>
            </div>

            <div class="card">
                <h3>Ingresos</h3>
                <p>$12,500</p>
            </div>
        </div>

        <!-- TABLA -->
        <h2>Usuarios</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Suscripcion_Status</th>
                    <th>Suscripcion_Start</th>
                    <th>Suscripcion_End</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->subscription_status }}</td>
                        <td>{{ $user->subscription_start }}</td>
                        <td>{{ $user->subscription_end }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    @endsection
</body>
</html>