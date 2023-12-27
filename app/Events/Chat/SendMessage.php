<?php

namespace App\Events\Chat;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $userNotification;

    /**
     * Create a new event instance.
     */
    public function __construct($message, string $userNotification)
    {
        $this->message = $message;
        $this->userNotification = $userNotification;
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<uuid, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('user.' . $this->userNotification),
        ];
    }

    public function broadcastAs(): string
    {
        return 'SendMessage';
    }

    public function broadcastWith(): array
    {
        $this->message->content = Crypt::decryptString($this->message->content);
        return [
            'message' => $this->message,
        ];
    }
}
