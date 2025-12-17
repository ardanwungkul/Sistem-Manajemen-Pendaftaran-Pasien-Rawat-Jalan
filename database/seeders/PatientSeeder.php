<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 100; $i++) {
            DB::table('patients')->insert([
                'name' => $faker->name,
                'nik' => $faker->unique()->numerify('################'),
                'gender' => $faker->randomElement(['L', 'P']),
                'birth_date' => $faker->dateTimeBetween('-70 years', '-10 years')->format('Y-m-d'),
                'phone' => $faker->unique()->numerify('08##########'),
                'address' => $faker->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
