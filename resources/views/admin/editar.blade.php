<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuarios</title>
<style>
body{
    background: radial-gradient(circle at top, #1a0b2e, #0a0a14);
    font-family: 'Segoe UI', sans-serif;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* CARD */
.card{
    width: 300px;
    padding: 30px;
    border-radius: 20px;
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(15px);
    box-shadow: 0 0 25px rgba(168,85,247,0.2);
}

/* TITULO */
h2{
    text-align: center;
    color: #c084fc;
    margin-bottom: 20px;
}

/* INPUTS */
input{
    width: 90%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 10px;
    border: none;
    outline: none;
    background: rgba(255,255,255,0.08);
    color: white;
    font-size: 14px;
    transition: 0.3s;
}

input:focus{
    box-shadow: 0 0 10px #a855f7;
}

/* BOTÓN */
button{
    width: 99%;
    padding: 12px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(135deg, #9333ea, #6d28d9);
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

button:hover{
    transform: scale(1.05);
    box-shadow: 0 0 15px #a855f7;
}

/* BOTÓN VOLVER */
.back{
    display: block;
    text-align: center;
    margin-top: 15px;
    color: #a855f7;
    text-decoration: none;
    font-size: 14px;
}

.back:hover{
    text-decoration: underline;
}
</style>
</head>
<body>
  <body>

    <div class="card">

        <h2>Editar Usuario</h2>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $user->name }}" placeholder="Nombre">

            <input type="email" name="email" value="{{ $user->email }}" placeholder="Correo">

            <input type="text" name="phone" value="{{ $user->phone }}" placeholder="Teléfono">

            <button>Actualizar</button>
        </form>

        <a href="{{ route('admin.usuarios') }}" class="back">
            ← Volver
        </a>

    </div>

</body>
</body>
</html>