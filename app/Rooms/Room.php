<?php

namespace App\Rooms;

use Illuminate\Database\Eloquent\Model;
use App\Locatable;
use App\Ships\Ship;

class Room extends Model
{
    use Locatable;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The default Location type for a new Locatable.
     * Must match a belongsTo relationship.
     *
     * @var string
     */
    public $locatedInside = 'ship';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }
}
