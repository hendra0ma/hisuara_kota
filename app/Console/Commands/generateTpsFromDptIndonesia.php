<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class generateTpsFromDptIndonesia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generateTpsFromDptIndonesia';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    private $lastProcessedIdPath;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        // $this->lastProcessedIdPath = storage_path('last_processed_id.txt');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $offset = (int) $this->getLastProcessedId();
        $village = DB::table("villages_2")->join('districts_2',function ($join) {
            $join->on('districts_2.id','=','villages_2.district_id')
            ->join('regencies_2','districts_2.regency_id','=','regencies_2.id')
            ->where("districts_2.regency_id",'3674');
        })
        ->orderBy('villages_2.id', 'asc')
        ->offset($offset)
        ->limit(1)
        ->select("villages_2.name",
        'districts_2.name as district_name',
        'regencies_2.name as regency_name',
        'villages_2.id as village_id',
        'districts_2.id as district_id',
        'regencies_2.id as regency_id')->first();
        
        $dptIndonesia = DB::table("dpt_indonesia")
        ->where('village_name',$village->name)
        ->where('district_name',$village->district_name)
        // ->where('regency_name',$village->regency_name)
        ->select("tps",DB::raw('COUNT(tps) as count'))
        ->groupBy('tps')
        ->having('count', '>', 1)
        ->get();
     
        $tps = [];
        $i = 1;
        foreach ($dptIndonesia as $value) {
            
            $timestamps = now();
            $tps[] = [
                "number"=>$i,
                "district_id"=>$village->district_id,
                "regency_id"=>$village->regency_id,
                "villages_id"=>$village->village_id,
                "setup"=>"belum terisi",
                "cek"=>0,
                "province_id"=>36,
                'dpt'=>$value->count,
                "created_at"=>$timestamps
                
            ];
            $i++;
        }
        DB::table("tps")->insert($tps);
        
        $this->updateLastProcessedId((int)$offset + 1);
        $this->info(json_encode($offset));

    }

    protected function getLastProcessedId()
    {
        return file_get_contents(storage_path('app/last_processed_village_id.txt'));
    }

    protected function updateLastProcessedId($id)
    {
        file_put_contents(storage_path('app/last_processed_village_id.txt'), $id);
    }


}
