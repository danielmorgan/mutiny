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


    /*
    |--------------------------------------------------------------------------
    | Observers
    |--------------------------------------------------------------------------
    */

    public static function boot()
    {
        /**
         * @todo Refactor. This should already happen on Locatable but the boot() function here is preventing that from running.
         */
        static::created(function($user) {
            // Set the default balance
            $user->balance = 6000;

            // Place the user on a ship crew
            $user->ship()->associate(Ship::first());

            // Put the new user in the first Room of this ship
            $user->location()->create([
                'locatable_id' => $user->id,
                'locatable_type' => User::class,
                'parent_id' => $user->ship->rooms()->first()->location->id,
            ]);

            $user->save();
        });
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
        // @todo Validate location is accessible

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
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
