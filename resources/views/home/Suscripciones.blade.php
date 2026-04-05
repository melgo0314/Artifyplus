<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
body{
    background: radial-gradient(circle at top, #1a0b2e, #0a0a14);
    font-family: 'Segoe UI', sans-serif;
    color: white;
    padding: 30px;
}

/* GRID */
.cards{
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 20px;
}

/* CARD */
.card{
    background: rgba(255,255,255,0.05);
    padding: 20px;
    border-radius: 18px;
    backdrop-filter: blur(10px);
    box-shadow: 0 0 20px rgba(168,85,247,0.2);
    transition: 0.3s;
}

.card:hover{
    transform: translateY(-5px);
    box-shadow: 0 0 30px rgba(168,85,247,0.4);
}

/* TITULO */
.card h3{
    color: #c084fc;
    margin-bottom: 10px;
}

/* TEXTO */
.card p{
    font-size: 14px;
    color: #ccc;
    margin: 5px 0;
}

/* ESTADO */
.status{
    display: inline-block;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    margin-bottom: 8px;
}

/* COLORES ESTADO */
.active{
    background: rgba(34,197,94,0.2);
    color: #22c55e;
}

.cancelled{
    background: rgba(239,68,68,0.2);
    color: #ef4444;
}

/* BOTÓN */
.btn-cancel{
    margin-top: 10px;
    width: 100%;
    padding: 8px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(135deg, #dc2626, #ef4444);
    color: white;
    cursor: pointer;
    transition: 0.3s;
}

.btn-cancel:hover{
    transform: scale(1.05);
    box-shadow: 0 0 15px red;
}

.btn-renew{
    margin-top: 8px;
    width: 100%;
    padding: 8px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: white;
    cursor: pointer;
    transition: 0.3s;
}

.btn-renew:hover{
    transform: scale(1.05);
    box-shadow: 0 0 15px #22c55e;
}
</style>
</head>
<body>
    <div class="cards">
    <a href="{{ route('home.index') }}" class="btn-back-home">
        <i class="fa-solid fa-house"></i> Inicio
    </a>
    @foreach($subs as $sub)
        <div class="card">

            <h3>{{ $sub->channel->name }}</h3>

            @if($sub->status == 'active')
                <span style="color:green;">Activa</span>
            @else
                <span style="color:red;">Cancelada</span>
            @endif

            <p>Inicio: {{ $sub->start_date }}</p>
            <p>Fin: {{ $sub->end_date }}</p>

            <form action="{{ route('subscriptions.cancel', $sub->id) }}" method="POST">
                @csrf
                @method('PUT')
                <button class="btn-cancel">Cancelar</button>
            </form>

            @if($sub->status != 'active')
                <form action="{{ route('subscriptions.renew', $sub->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="btn-renew">Renovar</button>
                </form>
            @endif

        </div>
    @endforeach

    </div>
</body>
</html>
