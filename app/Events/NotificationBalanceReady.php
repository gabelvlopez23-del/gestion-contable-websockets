<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class NotificationBalanceReady implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $empresaId;
    public string $message;
    public string $downloadUrl;

    public function __construct(int $empresaId, string $message, string $downloadUrl)
    {
        $this->empresaId = $empresaId;
        $this->message = $message;
        $this->downloadUrl = $downloadUrl;
    }

    public function broadcastOn(): array
    {
        return [new Channel('empresa.' . $this->empresaId)];
    }

    public function broadcastAs(): string
    {
        return 'NotificationBalanceReady';
    }
}
