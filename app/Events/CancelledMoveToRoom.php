<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\User;

class CancelledMoveToRoom
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var \App\User
     */
    public $user;

    /**
     * @var \App\Rooms\Room
     */
    public $currentLocation;

    /**
     * Create a new event instance.
     *
     * @param \App\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("user.{$this->user->id}");
    }
}
