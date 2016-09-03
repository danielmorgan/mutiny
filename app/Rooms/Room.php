<?php

namespace App\Rooms;

use Illuminate\Database\Eloquent\Model;
use LaravelCustomRelation\HasCustomRelations;
use App\Locatable;
use App\Ships\Ship;
use App\User;

class Room extends Model
{
    use Locatable, HasCustomRelations;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The default Location type for a new Locatable.
     * Must match a belongsTo relationship.
     *
     * @var string|null
     */
    public $locatedInside = 'ship';


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
     * @return \App\Relations\Custom
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
            },
            function($relation, $models) {
                $relation->getQuery()->whereIn('users.id', $relation->getKeys($models));
            }
        );
    }
}
