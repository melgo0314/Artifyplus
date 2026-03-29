@if (session('success'))
    <div id="alert" class="alert alert-success alert-dismissible d-flex align-items-center fade show">
        
        <i class="fa-solid fa-circle-check"></i>
        <!--Obtener mensaje desde la sesion-->
        <strong class="mx-2">Exito! </strong>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <script>
        setTimeout(function() {
        //obtener el elemento por el id
        let alerta = document.getElementById('alert');

        if(alerta){
            //quitar clase que permite ver la alerta
            alerta.classList.remove('show');
            //añadir animacion fade
            alerta.classList.remove('fade');

            setTimeout(() => alerta.remove(), 500);
        }

        }, 3000); //desaperecer despues de 3 segundos
    </script>
@endif

@if (session('error'))
    <div id="alert-error" class="alert alert-danger alert-dismissible fade show">
        <strong>Error:</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <script>
        setTimeout(function() {
            let alerta = document.getElementById('alert-error');

            if(alerta){
                alerta.classList.remove('show');

                setTimeout(() => alerta.remove(), 500);
            }

        }, 3000);
    </script>
@endif