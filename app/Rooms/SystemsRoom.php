<?php

namespace App\Rooms;

class SystemsRoom extends Room
{
    protected static $singleTableType = 'sys';
    protected static $throwInvalidAttributeExceptions = true;
    public $name = 'Systems Hub';
    public $description = '@todo: Write description for this room.';
    public $image = '/img/locations/systemsroom.jpg';
}
