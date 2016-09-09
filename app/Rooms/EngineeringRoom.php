<?php

namespace App\Rooms;

use App\Locatable;

class EngineeringRoom extends Room
{
    use Locatable;

    protected static $singleTableType = 'Engineering';
    protected static $throwInvalidAttributeExceptions = true;
}
