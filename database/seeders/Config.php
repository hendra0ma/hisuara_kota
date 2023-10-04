<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Config extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        

        // Insert Data to Database
        DB::table('config')->insert([
            'setup'=>'yes',
            'provinces_id' => 36,
            'regencies_id' => 3674,
            

        ]);
    }
}
