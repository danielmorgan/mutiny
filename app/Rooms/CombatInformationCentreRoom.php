<?php

namespace App\Rooms;

use App\Locatable;

class CombatInformationCentreRoom extends Room
{
    use Locatable;

    protected static $singleTableType = 'CombatInformationCenter';
    protected static $throwInvalidAttributeExceptions = true;
}
