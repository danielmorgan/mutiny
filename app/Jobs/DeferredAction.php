<?php

namespace App\Jobs;

use Carbon\Carbon;

abstract class DeferredAction
{
    /**
     * Time an action takes in seconds.
     *
     * @var int
     */
    public $duration = 1 * 60;

    /**
     * Return the human readable version of how long this action will take.
     *
     * @return string
     */
    public function when()
    {
        return Carbon::now()->addSeconds($this->duration)->diffForHumans();
    }

    /**
     * Magic method to access computed properties.
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (method_exists($this, $name)) {
            return $this->$name();
        }
    }
}
