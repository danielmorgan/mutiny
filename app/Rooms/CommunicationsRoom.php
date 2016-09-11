<?php

namespace App\Rooms;

class CommunicationsRoom extends Room
{
    protected static $singleTableType = 'com';
    protected static $throwInvalidAttributeExceptions = true;
    public $name = 'Communications Room';
}
