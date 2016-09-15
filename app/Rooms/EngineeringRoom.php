<?php

namespace App\Rooms;

class EngineeringRoom extends Room
{
    protected static $singleTableType = 'eng';
    protected static $throwInvalidAttributeExceptions = true;
    public $name = 'Engineering Bay';
    public $description = '@todo: Write description for this room.';
    public $image = '/img/locations/engineeringroom.jpg';
}
