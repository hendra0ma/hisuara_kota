<?php

namespace App\Console\Commands;

use App\Models\Regency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AddLogoKota extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GenerateLogoKota';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'GENERATE LOGO PROVINSI';

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
        $allFileName = [];
        foreach ($regency as $reg) {
            // $arrayName =  explode(" ",$reg->name);
            // if(trim($arrayName[0]) == "KABUPATEN"){
            //     // $kabLength = strlen($arrayName[0]);
            //     // $namaKab = substr($reg->name,$kabLength+1);

            $filename = $reg->name.".png";
            // }else{
            //     $filename = $reg->name.".png";
            // }
            $allFileName[$reg->id] = $filename;
            
            DB::table('regencies_2')->where("id",$reg->id)->update([
                "logo_kota"=> $filename
            ]);
        }
     $this->info(json_encode($allFileName));
    }
    
}
