<?php

namespace App\Console\Commands;

use App\Models\Bukti_deskripsi_curang;
use App\Models\Buktifoto;
use App\Models\Buktividio;
use App\Models\Kecurangan;
use App\Models\Qrcode;
use App\Models\Saksi;
use App\Models\SuratPernyataan;
use App\Models\User;
use App\Models\VideoPernyataan;
use Illuminate\Console\Command;

class GenerateKecurangan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generateKecurangan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate kecurangan dari table saksi ke table kecurangan karena perubahan semua pengguna dapat mengupload kecurangan';

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
        $saksi = Saksi::where('kecurangan','yes')->get();
        $dataKecurangan = [];
        foreach ($saksi as $key => $value) {
            $user = User::where('tps_id',$value->tps_id)->first();
            if ($user != null) {
                $kecurangan = new Kecurangan;
                $kecurangan->user_id =$user->id;
                $kecurangan->rekaman = "rekaman";
                $kecurangan->regency_id =$value->regency_id;
                $kecurangan->status_kecurangan =$value->status_kecurangan;
                $kecurangan->tps_id = $value->tps_id;
                $kecurangan->save();
                $kecuranganId = $kecurangan->id;
                $dataKecuranganId = [
                    'kecurangan_id'=>$kecuranganId
                ];
                $dataKecurangan[$kecuranganId] = [
                    "user_id"=>$user->id,
                    "rekaman"=>"rekaman",
                    "regency_id"=>$value->regency_id,
                    "status_kecurangan"=>$value->status_kecurangan,
                    "tps_id"=>$value->tps_id,
                ];
                VideoPernyataan::insert([
                    'video'=>"XWewkm2DnFUIrsyVuATToo71Ad5lS996OBfnF7fH.mp4",
                    "tps_id"=>$value->tps_id,
                    "user_id"=>$user->id,
                    "kecurangan_id"=>$kecuranganId
                ]);
                Bukti_deskripsi_curang::where('tps_id',$value->tps_id)->update($dataKecuranganId);
                Buktifoto::where('tps_id',$value->tps_id)->update($dataKecuranganId);
                Buktividio::where('tps_id',$value->tps_id)->update($dataKecuranganId);
                Qrcode::where('tps_id',$value->tps_id)->update($dataKecuranganId);
                SuratPernyataan::where('saksi_id',$value->id)->update($dataKecuranganId);
            }
        }
        $this->info(json_encode($dataKecurangan));
    }
}
