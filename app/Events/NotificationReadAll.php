<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationReadAll implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var int
     */
    public $userId;

    /**
     * Create a new event instance.
     *
     * @param  int $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;

        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return \Illuminate\Broadcasting\PrivateChannel
     */
    public function broadcastOn()
    {
        return new PrivateChannel("user.{$this->userId}");
    }
}
