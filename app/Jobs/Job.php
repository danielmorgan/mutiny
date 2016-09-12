<?php

namespace App\Jobs;

use Illuminate\Database\Eloquent\Model;
use App\Jobs\MoveToRoom;
use App\Jobs\MovingToMoreThanOneRoomAtATimeException;

class Job extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getActionAttribute()
    {
        return unserialize(json_decode($this->payload)->data->command);
    }

    public function getClassAttribute()
    {
        return json_decode($this->payload)->data->commandName;
    }


    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeUserMove($query)
    {
        $jobs = [];
        $query->get()
            ->filter(function($job) { return $job->action instanceof UserMove; })
            ->each(function($job) use (&$jobs) { $jobs[] = $job->id; });

        return $query->whereIn('jobs.id', $jobs);
    }

    public function scopeMoveToRoom($query)
    {
        $jobs = [];
        $query->get()
            ->filter(function($job) { return $job->class === MoveToRoom::class; })
            ->each(function($job) use (&$jobs) { $jobs[] = $job->id; });

        return $query->whereIn('jobs.id', $jobs);
    }


    /*
    |--------------------------------------------------------------------------
    | Observers
    |--------------------------------------------------------------------------
    */

    public static function boot()
    {
        static::created(function($job) {
            if (! Auth::check()) {
                return;
            }

            if (Auth::user()->jobs()->moveToRoom()->get()->count() > 1) {
                throw new MovingToMoreThanOneRoomAtATimeException;
            }
        });
    }
}
