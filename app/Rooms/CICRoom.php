<?php

namespace App\Rooms;

use App\LocationInterface;

class CICRoom extends Room
{
    protected static $singleTableType = 'cic';
    protected static $throwInvalidAttributeExceptions = true;
    public $name = 'Combat Information Centre';
    public $description = 'The nerve centre of the ship. Status readouts blink across terminals from several locations around the room. Signs above the exits read "CIC" in stencilled red letters. In the center a large table glows with incandescent light, illuminating the reams of lined computer paper which cover the surface.';
    public $image = '/img/locations/cicroom.jpg';
}
