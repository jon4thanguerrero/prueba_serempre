<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            [
                'id' => 1,
                'code' => Str::random(10),
                'name' => 'Bogota'
            ],
            [
                'id' => 2,
                'code' => Str::random(10),
                'name' => 'Medellin'
            ],
            [
                'id' => 3,
                'code' => Str::random(10),
                'name' => 'Villavicencio'
            ],
        ]);
    }
}
