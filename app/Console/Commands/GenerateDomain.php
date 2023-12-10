<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateDomain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GenerateDomainKota';

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
        $allDomain = [];
        foreach ($regency as $reg) {
            $arrayName = explode(" ",$reg->name);
            $province = DB::table('province_domains')->where('province_id',(string)$reg->province_id)->select('domain')->first();
        
            $namaProv = explode(".",$province->domain)[1];
            
            $namaKota = strtolower(implode("-",$arrayName));
            $namaKota = (trim($arrayName[0]) == "KOTA")?$namaKota:"kab-$namaKota";
          
            $Domain = "pilpres.$namaProv.$namaKota.hisuara.id";
            $timeStamp = now();
            $allDomain[$reg->id] = [
                "domain"=> $Domain,
                "regency_id"=>$reg->id,
                "province_id"=>$reg->province_id,
                "created_at"=>$timeStamp
            ];
            DB::table('regency_domains')->insert($allDomain[$reg->id]);
        }
     $this->info(json_encode($allDomain));
    }
}
