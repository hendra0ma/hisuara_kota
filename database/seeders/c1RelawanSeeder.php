<?php

namespace Database\Seeders;

use App\Models\Relawan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class c1RelawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $relawan = new Relawan();
        $relawan->c1_images = "1-53217-01-C1-PPWP-X14.jpg";
        $relawan->district_id = "3674040";
        $relawan->village_id = "3674040006";
        $relawan->regency_id = "3674";
        $relawan->relawan_id = 1;
        $relawan->tps_id = 1;
        $relawan->status = 0;
        $relawan->save();
        $relawanId = $relawan->id;
        // DB::table('c1_relawan_data')->insert([
        //     'relawan_id' => 1,
        //     'paslon_id' => 1,
        //     'village_id' => "3674040006",
        //     'regency_id' => "3674",
        //     'voice' => 12,
        //     'c1_relawan_id' => $relawanId,
        //     'district_id' => "3674040",
        // ]);
        // DB::table('c1_relawan_data')->insert([
        //     'relawan_id' => 1,
        //     'paslon_id' => 2,
        //     'village_id' => "3674040006",
        //     'regency_id' => "3674",
        //     'voice' => 15,
        //     'c1_relawan_id' => $relawanId,
        //     'district_id' => "3674040",
        // ]);
    }
}
