<?php

namespace App\Rooms;

class NavigationRoom extends Room
{
    protected static $singleTableType = 'nav';
    protected static $throwInvalidAttributeExceptions = true;
    public $name = 'Navigation Room';
    public $description = 'The navigation room is divided by transparent partitions covered in black lines describing complex orbits. An analogue radar display blinks gently in one corner. A black and white terminal sits at the center of the room listing discovered local targets in a simple text based interface.';
    public $image = '/img/locations/navigationroom.jpg';
}
