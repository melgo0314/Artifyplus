@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@elseif (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>

@elseif ($errors->any())
    <div class="alert alert-error">
        {{ $errors->first() }}
    </div>
@endif
<script>
    setTimeout(function() {
        let alerts = document.querySelectorAll('.alert');

        alerts.forEach(alerta => {
            alerta.style.opacity = "0";
            alerta.style.transition = "0.5s";
            
            setTimeout(() => {
                alerta.remove();
            }, 500);
        });

    }, 3000);
</script>