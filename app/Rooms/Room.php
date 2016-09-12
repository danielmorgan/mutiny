<?php

namespace App\Rooms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use LaravelCustomRelation\HasCustomRelations;
use Nanigans\SingleTableInheritance\SingleTableInheritanceTrait;
use App\Locatable;
use App\Ships\Ship;
use App\User;
use Auth;

class Room extends Model
{
    use Locatable, HasCustomRelations, SingleTableInheritanceTrait, Notifiable;

    /**
     * The default Location type for a new Locatable.
     * Must match a belongsTo relationship.
     *
     * @var string|null
     */
    public $locatedInside = 'ship';

    /**
     * @var string
     */
    public $name = 'All Purpose Room';

    /**
     * Send the given notification to everyone in the room.
     *
     * @param mixed $instance
     */
    public function notify($instance)
    {
        app(\Illuminate\Notifications\ChannelManager::class)->send($this->occupants, $instance);
    }

    /**
     * Send the given notification to everyone in the room except to passed user.
     *
     * @param mixed $instance
     * @param \App\User $exceptUser
     */
    public function notifyExcept($instance, User $exceptUser) {
        $targets = $this->occupants->filter(function($user) use($exceptUser) {
            return $user->id !== $exceptUser->id;
        });

        app(\Illuminate\Notifications\ChannelManager::class)->send($targets, $instance);
    }

    /*
    |--------------------------------------------------------------------------
    | Eloquent/Laravel default overrides
    |--------------------------------------------------------------------------
    */

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'type';
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
    | Single table inheritence
    |--------------------------------------------------------------------------
    */

    /**
     * @var string
     */
    protected $table = 'rooms';

    /**
     * @var string
     */
    protected static $singleTableTypeField = 'type';

    /**
     * @var array
     */
    protected static $singleTableSubclasses = [
        CICRoom::class,
        CommunicationsRoom::class,
        NavigationRoom::class,
        SystemsRoom::class,
        EngineeringRoom::class,
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }

    /**
     * @return \LaravelCustomRelation\Relations\Custom;
     */
    public function occupants()
    {
        return $this->custom(User::class,
            function($relation) {
                $relation->getQuery()
                    ->join('locations', 'users.id', '=', 'locations.locatable_id')
                    ->where([
                        ['locations.locatable_type', User::class],
                        ['locations.parent_id', $this->location->id],
                    ]);
            }, function() {
                throw new \DomainException('Eager loading of Custom relationships not supported yet.');
            });
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "$this->name";
    }


    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getDescriptionAttribute()
    {
        return 'This is a test room description.';
    }
}
