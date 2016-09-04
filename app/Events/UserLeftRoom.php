<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\User;
use App\Rooms\Room;

class UserLeftRoom implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var \App\User
     */
    private $user;
    
    /**
     * @var \App\Rooms\Room
     */
    private $room;

    /**
     * Create a new event instance.
     *
     * @param \App\User $user
     * @param \App\Rooms\Room $room
     */
    public function __construct(User $user, Room $room)
    {
        $this->user = $user;
        $this->room = $room;

        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\PresenceChannel
     */
    public function broadcastOn()
    {
        return new PresenceChannel("room.{$this->room->id}");
    }
}
