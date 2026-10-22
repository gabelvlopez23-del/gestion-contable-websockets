<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FacturaEmitida implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // Propiedades públicas que se enviarán en formato JSON al navegador
    public string $numeroFactura;
    public float $total;
    public string $mensaje;

    public function __construct(string $numeroFactura, float $total)
    {
        $this->numeroFactura = $numeroFactura;
        $this->total = $total;
        $this->mensaje = "¡Nueva transacción contable registrada en tiempo real!";
    }

    // Definición del canal público de facturación
    public function broadcastOn(): array
    {
        return [new Channel('facturacion-channel')];
    }

    // Nombre específico del evento para escuchar en JavaScript sin prefijos
    public function broadcastAs(): string
    {
        return 'FacturaEmitida';
    }
}
