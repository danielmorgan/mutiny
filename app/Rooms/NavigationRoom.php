<?php

namespace App\Rooms;

class NavigationRoom extends Room
{
    protected static $singleTableType = 'nav';
    protected static $throwInvalidAttributeExceptions = true;
    public $name = 'Navigation Room';
    public $description = '@todo: Write description for this room.';
    public $image = '/img/locations/navigationroom.jpg';
}
