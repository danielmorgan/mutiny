<?php

namespace App\Events;

use App\Location;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\User;

class UserEnteredLocation
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var Location
     */
    public $location;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, Location $location)
    {
        $this->user = $user;
        $this->location = $location;
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
