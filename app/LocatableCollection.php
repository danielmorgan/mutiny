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
            } else {
                $locatables[] = $location->name;
            }
        }

        return new LocatableCollection($locatables);
    }

    public function instantiables()
    {
        $instantiables = [];

        foreach ($this as $location) {
            if ($location->isInstantiable()) {
                $instantiables[] = $location->locatable_type;
            }
        }

        return new LocatableCollection($instantiables);
    }
}
