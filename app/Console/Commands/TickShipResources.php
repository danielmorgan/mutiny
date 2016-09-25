<?php

namespace App\Console\Commands;

use App\Ships\Resource;
use Illuminate\Console\Command;

class TickShipResources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:tick:ship-resources {ship}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use up ship resources for one game tick.';

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
        $ship = $this->arguments()['ship'];

        foreach (Resource::$types as $resource) {
            $ship->resource->$resource += $ship->resourceChange($resource);
            $this->info($ship . ' | ' . $resource . ': ' . $ship->resource->$resource);
        }

        $ship->resource->save();
    }
}
