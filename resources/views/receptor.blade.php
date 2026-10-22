<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Auditoría Contable (Tiempo Real)</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://jsdelivr.net"></script>
    <style>
        body { font-family: system-ui, sans-serif; padding: 40px; background-color: #f3f4f6; }
        .wrap { max-width: 700px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        #target-div { padding: 20px; border: 2px dashed #3b82f6; border-radius: 8px; background: #eff6ff; color: #1e40af; font-weight: 500; text-align: center; }
    </style>
</head>
<body>
<div class="wrap">
    <h1>📊 Panel del Auditor en Vivo</h1>
    <p>Esta pantalla simula la terminal del Administrador o Contador que monitorea transacciones remotas.</p>
    <div id="target-div">Conectando al servidor de WebSockets y esperando transacciones contables...</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const targetDiv = document.getElementById('target-div');
    
    // Suscripción al canal de facturación configurado en Reverb
    window.Echo.channel('facturacion-channel')
        .listen('.FacturaEmitida', (e) => {
            // 1. Modificar el contenedor interno de la página sin recargar
            targetDiv.innerHTML = `🧾 <b>Factura Registrada:</b> ${e.numeroFactura} <br> 💰 <b>Monto Total:</b> $${e.total.toLocaleString('es-AR')}`;
            targetDiv.style.borderColor = '#10b981';
            targetDiv.style.background = '#ecfdf5';
            targetDiv.style.color = '#065f46';

            // 2. Disparar el cartel Toast interactivo e inmediato
            Swal.fire({
                icon: 'success',
                title: '¡Nueva Factura de Venta!',
                text: `${e.mensaje} N°: ${e.numeroFactura} por un total de $${e.total.toLocaleString('es-AR')}`,
                confirmButtonColor: '#3b82f6',
                timer: 5000,
                timerProgressBar: true
            });
        });
});
</script>
</body>
</html>
