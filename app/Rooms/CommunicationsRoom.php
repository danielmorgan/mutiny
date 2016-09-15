<?php

namespace App\Rooms;

class CommunicationsRoom extends Room
{
    protected static $singleTableType = 'com';
    protected static $throwInvalidAttributeExceptions = true;
    public $name = 'Communications Room';
    public $description = '@todo: Write description for this room.';
    public $image = '/img/locations/communicationsroom.jpg';
}
