<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationRead implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var int
     */
    public $userId;

    /**
     * @var int
     */
    public $notificationId;

    /**
     * Create a new event instance.
     *
     * @param  int $userId
     * @param  int $notificationId
     */
    public function __construct($userId, $notificationId)
    {
        $this->userId = $userId;
        $this->notificationId = $notificationId;

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
