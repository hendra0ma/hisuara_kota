<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\SaksiData;
use App\Models\Paslon;
use App\Models\Province;
use App\Models\SuaraC1Province;
use App\Models\SuaraC1Provinsi;
use Illuminate\Support\Facades\Log;

class UpdateDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $batch;

    public function __construct($batch)
    {
        $this->batch = $batch;
    }
    
    public function handle()
    {
        $limit = 1000;
        $offset = $this->batch * $limit;
    
        $saksiData = SaksiData::skip($offset)->take($limit)->get();
        $prov = Province::get();
        foreach ($saksiData as $data) {
            $paslonId = $data->paslon_id;
            $totalVoice = 
            SuaraC1Provinsi::where()->update(
                [
                    
                ]
            );
        }
    
       Log::info('Batch ' . $this->batch . ' berhasil diupdate!');
    }
    
}
