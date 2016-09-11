<?php

namespace App\Rooms;

class EngineeringRoom extends Room
{
    protected static $singleTableType = 'eng';
    protected static $throwInvalidAttributeExceptions = true;
    public $name = 'Engineering Bay';
}
