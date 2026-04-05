<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Usuarios</title>
    @extends('layouts.app')

    @section('container-class', '')

    @section('content')

<style>
body{
    background: radial-gradient(circle at top, #1a0b2e, #0a0a14);
    color: #fff;
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
    padding: 30px;
}

/* CONTENEDOR */
.container{
    max-width: 1100px;
    margin: auto;
    padding: 25px;
    border-radius: 20px;
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(15px);
    box-shadow: 0 0 30px rgba(168,85,247,0.15);
}

/* HEADER */
.header{
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 25px;
}

h2{
    color: #c084fc;
    letter-spacing: 1px;
}

/* BOTÓN CREAR */
.header-buttons{
    display: flex;
    flex-direction: column; 
    gap: 10px;
    align-items: flex-end;
}

/* BOTONES */
.btn-create{
    background: linear-gradient(135deg, #9333ea, #6d28d9);
    padding: 10px 18px;
    border-radius: 10px;
    color: white;
    font-weight: bold;
    transition: 0.3s;
    text-decoration: none;
    display: inline-block;
}

.btn-create:hover{
    transform: scale(1.05);
    box-shadow: 0 0 15px #a855f7;
}

/* TABLA */
table{
    width: 100%;
    border-collapse: collapse;
    border-radius: 15px;
    overflow: hidden;
}

/* HEADER TABLA */
thead{
    background: linear-gradient(90deg, #1f1f2e, #2a1a3f);
}

th{
    padding: 15px;
    font-size: 13px;
    text-transform: uppercase;
    color: #a855f7;
}

/* FILAS */
tbody tr{
    transition: 0.3s;
}

tbody tr:nth-child(even){
    background: rgba(255,255,255,0.03);
}

tbody tr:hover{
    background: rgba(168,85,247,0.15);
    transform: scale(1.01);
}

/* CELDAS */
td{
    padding: 12px;
    text-align: center;
}

/* BADGE SUSCRIPCIONES */
.badge{
    background: #6d28d9;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    box-shadow: 0 0 8px rgba(168,85,247,0.6);
}

/* BOTONES */
.actions{
    display: flex;
    justify-content: center;
    gap: 8px;
}

.btn-edit{
    background: #2563eb;
    padding: 6px 12px;
    border-radius: 8px;
    color: white;
    font-size: 12px;
    transition: 0.2s;
}

.btn-edit:hover{
    background: #3b82f6;
    transform: scale(1.05);
}

.btn-delete{
    background: #dc2626;
    border: none;
    padding: 6px 12px;
    border-radius: 8px;
    color: white;
    cursor: pointer;
    transition: 0.2s;
}

.btn-delete:hover{
    background: #ef4444;
    box-shadow: 0 0 10px red;
    transform: scale(1.05);
}

/* RESPONSIVE */
@media(max-width:768px){
    .header{
        flex-direction: column;
        gap: 10px;
    }
}
.alert.warning{
    background: rgba(255, 193, 7, 0.15); 
    color: #facc15; 
    border: 1px solid #facc15;
    padding: 12px;
    border-radius: 12px;
    margin-bottom: 15px;

    box-shadow: 0 0 15px rgba(250,204,21,0.3);

    display: flex;
    align-items: center;
    gap: 10px;
}
</style>
</head>
<body>
    <div class="container">

        <div class="header">
            <h2>Gestión de Usuarios</h2>

        <div class="header-buttons">
            <a href="{{ route('admin.users.create') }}" class="btn-create">
                <i class="fa-solid fa-plus"></i> Crear Usuario
            </a>

            <a href="{{ route('admin.dashboard') }}" class="btn-create">
                <i class="fa-solid fa-arrow-left"></i> Regresar
            </a>
        </div>
    </div>
        @include('partials.alerts')
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Suscripciones</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>

                <td>
                    <span class="badge">
                        {{ $user->channels->count() }}
                    </span>
                </td>

                <td>
                    <div class="actions">

                        <a href="{{ route('admin.users.editar', $user->id) }}" class="btn-edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button 
                            class="btn-delete" 
                            onclick="return confirm('¿Seguro que deseas eliminar este registro?')">
                            <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>

                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    </div>
    @endsection
</body>
</html>