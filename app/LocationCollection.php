<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

class LocationCollection extends Collection
{
    public function threaded()
    {
        $locations = $this->groupBy('parent_id');

        if (count($locations) && isset($locations[''])) {
            $locations['root'] = $locations[''];
            unset($locations['']);
        }

        return $locations;
    }
}
