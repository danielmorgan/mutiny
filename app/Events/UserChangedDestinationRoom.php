<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\User;
use App\Rooms\Room;

class UserChangedDestinationRoom implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var \App\User
     */
    public $user;

    /**
     * @var \App\Rooms\Room
     */
    public $newTarget;

    /**
     * Create a new event instance.
     *
     * @param \App\User $user
     * @param \App\Rooms\Room $newTarget
     */
    public function __construct(User $user, Room $newTarget)
    {
        $this->user = $user;
        $this->newTarget = $newTarget;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\PresenceChannel
     */
    public function broadcastOn()
    {
        return new PrivateChannel("user.{$this->user->id}");
    }
}
