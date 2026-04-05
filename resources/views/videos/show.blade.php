
    @extends('layouts.app')
    @section('content')
    @section('container-class', '') 

<style>
body{
    background: radial-gradient(circle at top, #1a0b2e, #0a0a14);
    color: white;
    font-family: 'Segoe UI', sans-serif;
}

/* CONTENEDOR */
.container{
    max-width: 900px;
    margin: auto;
    padding: 25px;
}

/* HEADER */
.header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

h2{
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

/* VIDEO */
.video-container{
    margin-bottom: 20px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(168,85,247,0.3);
}

/* DESCRIPCIÓN */
.desc{
    color: #ccc;
    margin-bottom: 20px;
}

/* COMENTARIOS */
.comment{
    background: rgba(255,255,255,0.05);
    padding: 12px;
    border-radius: 12px;
    margin-bottom: 10px;
    box-shadow: 0 0 10px rgba(168,85,247,0.1);
}

.comment small{
    color: #a855f7;
}

/* FORM */
textarea{
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #8000ff;
    background: rgba(255,255,255,0.05);
    color: white;
    margin-top: 10px;
    outline: none;
}

textarea:focus{
    box-shadow: 0 0 10px #a855f7;
}

/* BOTÓN */
.btn-comment{
    margin-top: 10px;
    background: linear-gradient(135deg, #9333ea, #6d28d9);
    padding: 8px 14px;
    border-radius: 10px;
    border: none;
    color: white;
    cursor: pointer;
    transition: 0.3s;
}

.btn-comment:hover{
    transform: scale(1.05);
    box-shadow: 0 0 15px #a855f7;
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
.comment{
    position: relative;
    padding-bottom: 50px; 
}

/* CONTENEDOR DE BOTONES */
.actions{
    position: absolute;
    bottom: 10px;
    right: 10px;
    display: flex;
    gap: 8px;
}

.actions form{
    margin: 0;
}
</style>
</head>
<body>
    <div class="container">

        <div class="header">
            <h2>{{ $video->title }}</h2>

            
            <a href="{{ route('canal.videos', $video->channel_id) }}" class="btn-back">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar
            </a>
        </div>

        <div class="video-container">
            <iframe 
                width="100%" 
                height="400"
                src="{{ str_replace('watch?v=', 'embed/', $video->url) }}" 
                frameborder="0" 
                allowfullscreen>
            </iframe>
        </div>

        <p class="desc">{{ $video->description }}</p>

        
        <h3>Comentarios</h3>

    @foreach($video->comments as $comment)
    <div class="comment">

        <p>{{ $comment->content }}</p>
        <small>Por: {{ $comment->user->name }}</small>

        @if(Auth::id() == $comment->user_id)

            <div class="actions">
                <a href="{{ route('videos.show', ['id' => $video->id, 'edit' => $comment->id]) }}" class="btn-edit">
                   <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn-delete"><i class="fa-solid fa-trash-can"></i></button>
                </form>
            </div>
            
            <div class="edit-box">
                @if(request('edit') == $comment->id)

                <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <textarea name="content">{{ $comment->content }}</textarea>

                    <button class="btn-comment">Actualizar</button>
                </form>

            @endif
            </div>

        @endif

    </div>
    @endforeach

        <form action="{{ route('comments.store') }}" method="POST">
            @csrf

            <textarea name="content" placeholder="Escribe un comentario..." required></textarea>

            <input type="hidden" name="video_id" value="{{ $video->id }}">

            <button class="btn-comment">Comentar</button>
        </form>

    </div>

    @endsection
</body>
</html>
