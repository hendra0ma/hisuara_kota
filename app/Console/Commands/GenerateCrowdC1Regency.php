<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateCrowdC1Regency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GenerateCrowdC1Regency';

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
        $regency = DB::table('regencies_2')->get();
        $allReg = [];
        $timestamps = now();
        foreach ($regency as $reg) {
            $allReg[] = [
                "id"=>$reg->id,
                "name"=>$reg->name,
                "province_id"=>$reg->province_id,
                "created_at"=>$timestamps

            ];
        }
        DB::table('regency_crowd_c1')->insert($allReg);
     $this->info(json_encode($allReg));
    }
}
