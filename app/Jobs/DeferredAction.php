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
     * Description of the action being taken.
     *
     * @var string
     */
    public $description = 'You\'re doing something, but can\'t for the life of you remember what it is...';

    /**
     * A url the window will be redirected to if the site is already open.
     * Does not get used in notification actions yet.
     *
     * @var string
     */
    public $completedUrl;

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
