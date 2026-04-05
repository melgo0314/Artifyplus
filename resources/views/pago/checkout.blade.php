<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago('APP_USR-5920006210451889-040316-8b20851e0d2361d35f52808a1ae70605-3310775443', {
        locale: 'es-MX'
    });
</script>

<div id="wallet_container"></div>

<script>
    mp.bricks().create("wallet", "wallet_container", {
        initialization: {
            preferenceId: "{{ $preferenceId }}"
        }
    });
</script>