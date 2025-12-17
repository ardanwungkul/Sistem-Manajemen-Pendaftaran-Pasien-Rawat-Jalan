<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $polies = DB::table('polies')->pluck('id')->toArray();

        for ($i = 1; $i <= 30; $i++) {
            DB::table('doctors')->insert([
                'name' => 'dr. ' . $faker->name,
                'poly_id' => $faker->randomElement($polies),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
