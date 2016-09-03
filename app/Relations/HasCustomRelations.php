<?php

namespace App\Relations;

use Closure;

trait HasCustomRelations
{
    /**
     * Define a custom relationship.
     *
     * @param string  $related
     * @param \Closure $baseConstraints
     * @param \Closure $eagerConstraints
     * @return \App\Services\Database\Relations\Custom
     */
    public function custom($related, Closure $baseConstraints, Closure $eagerConstraints)
    {
        $instance = new $related;
        $query = $instance->newQuery();

        return new Custom($query, $this, $baseConstraints, $eagerConstraints);
    }
}
