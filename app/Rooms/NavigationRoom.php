<?php

namespace App\Rooms;

class NavigationRoom extends Room
{
    protected static $singleTableType = 'nav';
    protected static $throwInvalidAttributeExceptions = true;
    public $name = 'Navigation Room';
}
