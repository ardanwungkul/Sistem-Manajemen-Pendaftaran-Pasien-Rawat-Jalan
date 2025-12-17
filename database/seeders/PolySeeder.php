<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PolySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polies = [
            'Poli Umum',
            'Poli Gigi',
            'Poli Anak',
            'Poli Kandungan',
            'Poli Penyakit Dalam',
            'Poli Saraf',
            'Poli Mata',
            'Poli THT',
            'Poli Bedah',
            'Poli Jantung',
        ];

        foreach ($polies as $poly) {
            DB::table('polies')->insert([
                'name' => $poly,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
