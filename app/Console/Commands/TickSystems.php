<?php

namespace App\Console\Commands;

use App\Systems\Generator;
use Illuminate\Console\Command;

class TickSystems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:tick:systems';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate current outputs for all generators.';

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
        Generator::all()->each(function(Generator $generator) {
            $generator->updatedOutputs()->save();
        });
    }
}
