<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'nik'=>234459293,
            'name'=>"Hendra Maulidan",
            "address"=>"jalan mahkota jamrud",
            "no_hp"=>"08978343435",
            "districts"=> 3674040,
            'villages'=>3674040006,
            "role_id"=>1,
            "is_active"=>1,
            "email"=>"hendra0maulidan@gmail.com",
            "email_verified_at"=>null,
            "password"=> '$2y$10$LOX1tdABk4D5AKdm9w.oXeqvnxDyyhqHQg5ifN3nB5g/U8Q2cdg0W',
            "created_at"=>now(),
            "updated_at"=>now(),

        ]);
        DB::table('users')->insert([
            'nik'=>23829433,
            'name'=>"Aditya Sundawa",
            "address"=>"jalan mahkota jamrud",
            "no_hp"=>"08128373822",
            "districts"=> 3674040,
            'villages'=>3674040006,
            "role_id"=>1,
            "is_active"=>1,
            "email"=>"adityasundawa.co@gmail.com",
            "email_verified_at"=>null,
            "password"=> '$2y$10$5eA9RcLPmRii0VZhXeAyQ.o7Dl67WlNqzQnpyajiH3ZI/rvxD38ha',
            "created_at"=>now(),
            "updated_at"=>now(),

        ]);



    }
}
