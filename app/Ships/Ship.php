<?php

namespace App\Ships;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\ChannelManager;
use App\Locatable;
use App\User;
use App\Rooms\Room;

class Ship extends Model
{
    use Notifiable, Locatable;

    /**
     * The default Location type for a new Locatable.
     * Must match a belongsTo relationship.
     * If null, the default Location will be the root node.
     *
     * @var string|null
     */
    public $locatedInside = null;

    /**
     * @var string
     */
    public $locationType = 'Ship';

    /**
     * @var string
     */
    public $description = 'I\'ts a bloody spaceship! What more could you possibly want?';

    /**
     * @var string
     */
    public $image = '/img/locations/ship.jpg';

    /**
     * @var bool
     */
    public $userCanEnter = true;

    /**
     * @var bool
     */
    public $shipCanEnter = false;


    /**
     * @var array
     */
    protected $fillable = ['name'];

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

    /**
     * Send the given notification.
     *
     * @param  mixed  $instance
     * @return void
     */
    public function notify($instance)
    {
        app(ChannelManager::class)->send($this->crew, $instance);
    }


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function crew()
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }


    /*
    |--------------------------------------------------------------------------
    | Resources
    |--------------------------------------------------------------------------
    */

    /**
     * Ship resource maximums.
     *
     * @var array
     */
    public static $resourceMax = [
        'hull' => 250,
        'armor' => 500,
        'propellant' => 2000,
        'fuel' => 100,
        'energy' => 50000,
    ];

    /**
     * How much of a resource will be used each tick.
     *
     * @var array
     */
    public $resourceUse = [
        'energy' => 10
    ];

    public function usePerTick($resource)
    {
        return $this->resourceUse[$resource];
    }
}
