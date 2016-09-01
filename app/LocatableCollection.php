<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

class LocatableCollection extends Collection
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

    public function locatables()
    {
        $locatables = [];

        foreach ($this as $location) {
            if ($location->isLocatable()) {
                $locatables[] = $location->locatable;
            } else if ($location->locatable_id == null) {
                $locatables[] = new $location->locatable_type;
            } else {
                $locatables[] = $location->name;
            }
        }

        return new LocatableCollection($locatables);
    }
}
