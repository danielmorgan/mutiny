<?php

namespace App\Rooms;

class SystemsRoom extends Room
{
    protected static $singleTableType = 'sys';
    protected static $throwInvalidAttributeExceptions = true;
    public $name = 'Systems Hub';
}
