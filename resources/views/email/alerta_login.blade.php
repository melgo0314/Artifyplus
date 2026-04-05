<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        .container{
            font-family: Arial;
            background:#f4f4f4;
            padding: 20px;
        }
        .content{
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .btn{
            background: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <center>
        <div class="container">
            <div class="content">
                <h1>Nuevo inicio de sesion detectado</h1>
                <p>Se ha detectado nueva actividad en tu cuenta</p>

                <a href="{{route('acceso')}}" class="btn" style="color:white;">
                    Verificar actividad
                </a>
                <p style="margin-top:20px;">Si no fuiste tu, contacta con el administrador del sistema</p>
            </div>

        </div>
    </center>
</body>
</html>
