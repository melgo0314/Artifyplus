@if (session('success'))
    <div class="alert-custom success">
        {{ session('success') }}
    </div>

@elseif (session('error'))
    <div class="alert-error">
        {{ session('error') }}
    </div>

@elseif ($errors->any())
    <div class="alert-custom-error">
        {{ $errors->first() }}
    </div>
@endif
<script>
    setTimeout(function() {
        let alerts = [
            document.getElementById('alert-custom-success'),
            document.getElementById('alert-error'),
            document.getElementById('alert-custom-error')
        ];

        alerts.forEach(alerta => {
            if(alerta){
                alerta.style.opacity = "0";
                alerta.style.transition = "0.5s";
                setTimeout(() => alerta.remove(), 500);
            }
        });

    }, 3000);
</script>