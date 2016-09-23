<?php

namespace App\Ships;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Notifications\Notifiable;
use App\Locatable;
use App\Rooms\Room;
use App\Systems\Generator;
use App\User;

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

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
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

    public function resource()
    {
        return $this->hasOne(Resource::class, 'ship_id');
    }

    public function systems()
    {
        return $this->hasManyThrough(Generator::class, Room::class);
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
        'fuel' => 5000,
        'energy' => 50000,
    ];

    public function resourceChange($resource)
    {
        return $this->systems->sum(function($system) use ($resource) {
            $input = 0;
            $output = 0;
            if ($system["{$resource}_in"]) $input = $system["{$resource}_in"];
            if ($system["{$resource}_out"]) $output = $system["{$resource}_out"];

            return - $input + $output;
        });
    }
}
