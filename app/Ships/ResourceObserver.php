<?php

namespace App\Ships;

use App\Ships\Resource;

class ResourceObserver
{
    public function updating(Resource $resource)
    {
        foreach (Resource::$types as $type) {
            if ($resource->$type < 0) {
                return false;
            }
        }
    }
}
