<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Ships\Ship;

class Tick extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:tick';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run one game tick.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Ship::all()->each(function ($ship) {
            $this->call('game:tick:ship-resources', ['ship' => $ship]);
        });
    }
}
