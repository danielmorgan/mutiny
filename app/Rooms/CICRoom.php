<?php

namespace App\Rooms;

class CICRoom extends Room
{
    protected static $singleTableType = 'cic';
    protected static $throwInvalidAttributeExceptions = true;
    public $name = 'Combat Information Centre';
}
