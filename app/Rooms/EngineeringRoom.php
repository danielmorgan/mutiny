<?php

namespace App\Rooms;

class EngineeringRoom extends Room
{
    protected static $singleTableType = 'engineering';
    protected static $throwInvalidAttributeExceptions = true;
    public $name = 'Engineering Room';
}
