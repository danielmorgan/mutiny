<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use LaravelCustomRelation\HasCustomRelations;
use NotificationChannels\WebPush\HasPushSubscriptions;
use App\Wallet\HasWallet;
use App\Ships\Ship;
use App\Rooms\Room;
use App\Jobs\Job;
use Auth;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasPushSubscriptions, HasWallet, Locatable, HasCustomRelations;

    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The default Location type for a new Locatable. Must match a belongsTo
     * relationship. If null, the default Location will be the root node.
     *
     * @var string|null
     */
    public $locatedInside = 'ship';

    /**
     * @var bool
     */
    public $userCanEnter = false;

    /**
     * @var bool
     */
    public $shipCanEnter = false;

    /**
     * @var string
     */
    public $locationType = 'User';

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return str_slug($this->getAttribute($this->getRouteKeyName()));
    }


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function ship()
    {
        return $this->belongsTo(Ship::class, 'ship_id');
    }

    public function room()
    {
        $roomId = 0;
        try {
            $roomId = $this->location->parent->locatable->id;
        } catch (\Exception $e) {}

        return $this->custom(Room::class,
            function($relation) use ($roomId) {
                $relation->getQuery()
                    ->join('locations', 'rooms.id', '=', 'locations.locatable_id')
                    ->where([
                        ['locations.locatable_type', 'LIKE', '%Room'],
                        ['locations.locatable_id', $roomId],
                    ]);
            },
            function($relation, $models) {
                throw new \DomainException('Eager loading of Custom relationships not supported yet.');
            });
    }

    public function jobs()
    {
        return $this->custom(Job::class,
            function($relation) {
                $usersJobs = [];
                foreach ($relation->getQuery()->get() as $job) {
                    try {
                        $payload = json_decode($job->toArray()['payload']);
                        $action = unserialize($payload->data->command);
                        if ($action->user->id == $this->id) {
                            $usersJobs[] = $job->id;
                        }
                    } catch (\Exception $e) {}
                }

                $relation->getQuery()->whereIn('jobs.id', $usersJobs);
            },
            function($relation, $models) {
                throw new \DomainException('Eager loading of Custom relationships not supported yet.');
            });
    }

    public function reachableLocations()
    {
        return $this->location->parent->enterableByUser();
    }


    /*
    |--------------------------------------------------------------------------
    | Domain specific methods
    |--------------------------------------------------------------------------
    */

    /**
     * Move User to a Location.
     *
     * @param \App\Location $location
     */
    public function moveTo(Location $location)
    {
        $this->location->update(['parent_id' => $location->id]);
    }

    /**
     * @return bool
     */
    public function isYou()
    {
        return $this->id == Auth::user()->id;
    }

    /**
     * @return \App\Location|null
     */
    public function getTargetLocationAttribute()
    {
        if ($this->isMoving()) {
            return $this->jobs()->userMove()->get()->first()->action->location->location;
        }

        return null;
    }

    /**
     * @param Location $location
     * @return bool
     */
    public function isInLocation(Location $location)
    {
        return $this->location->parent->id == $location->id;
    }

    /**
     * @return bool
     */
    public function isMoving()
    {
        return ! $this->jobs()->userMove()->get()->isEmpty();
    }

    /**
     * @param Location $location
     * @return bool
     */
    public function isMovingToLocation(Location $location)
    {
        if (! $this->isMoving()) {
            return false;
        }

        return $this->targetLocation->id == $location->id;
    }

    /**
     * @param \App\Ships\Ship $ship
     * @return bool
     */
    public function isInShip(Ship $ship)
    {
        return $this->ship->id === $ship->id;
    }

    /**
     * @param \App\Rooms\Room $room
     * @return bool
     */
    public function isInRoom(Room $room)
    {
        return $this->location->parent->id == $room->location->id;
    }

    /**
     * @return bool
     */
    public function isInARoom()
    {
        return strpos($this->location->parent->locatable_type, 'Room') !== false;
    }

    /**
     * @param \App\Rooms\Room $room
     * @return bool
     */
    public function isMovingToRoom(Room $room)
    {
        if (! $this->isMovingToARoom()) {
            return false;
        }

        return $this->targetRoom->id == $room->id;
    }

    /**
     * @return bool
     */
    public function isMovingToARoom()
    {
        return ! $this->jobs()->moveToRoom()->get()->isEmpty();
    }

    /**
     * @return \App\Rooms\Room|null
     */
    public function getTargetRoomAttribute()
    {
        if ($this->isMovingToARoom()) {
            return $this->jobs()->moveToRoom()->get()->first()->action->room;
        }

        return null;
    }

    /**
     * @param \App\Location $location
     * @return bool
     */
    public function canReach(Location $location)
    {
        return ! $this->reachableLocations()->where('id', $location->id)->isEmpty();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
