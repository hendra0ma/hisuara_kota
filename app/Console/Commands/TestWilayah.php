<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use AzisHapidin\IndoRegion\RawDataGetter;

class TestWilayah extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testWilayah';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $villages = RawDataGetter::getVillages();

        // Insert Data with Chun
        
       $this->info($villages);
    }
}
