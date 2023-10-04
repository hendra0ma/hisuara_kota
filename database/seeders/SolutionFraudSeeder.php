<?php

namespace Database\Seeders;

use App\Models\SolutionFraud;
use Illuminate\Database\Seeder;

class SolutionFraudSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['solution'=>'Rekomendasi perhitungan suara ulang.',],//suara kandidat tidak sesuai
            ['solution'=>'Rekomendasi Pemungutan suara ulang'],//ada kotak suara tersegel
            ['solution'=>'Rekomendasi untuk melaporkan kasus perdata'],//petugas kpps terbukti melakukan kecurangan
            ['solution'=>'Rekomendasi untuk melaporkan kasus pidana'],
        ];
            foreach($data as $dat){
                SolutionFraud::create($dat);
            }
    }
}
