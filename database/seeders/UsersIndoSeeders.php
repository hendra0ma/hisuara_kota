<?php

namespace Database\Seeders;
use Faker\Provider\id_ID\Person;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsersIndoSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
         for ($i = 1; $i < 58; $i++) {
          DB::table('users')->insert([
            'nik'=> $faker->creditCardNumber,
            'name'=> $faker->name,
            "address"=> $faker->address,
            "no_hp"=> $faker->phoneNumber,
            "districts"=> 3674040,
            'villages'=>3674040006,
            "role_id"=> 2,
            "is_active"=>1,
            "email"=> $faker->email,
            "email_verified_at"=>null,
            "password"=> Hash::make('admin'),
            "created_at"=>now(),
            "updated_at"=>now(),
            "tps_id" => 0,
            "cek" => 0,
        ]);
    }
    }
}
