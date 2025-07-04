<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\JadwalPeriksa;
use App\Models\JanjiPeriksa;

class JanjiPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $pasien = User::where('role', 'pasien')->first();
        $jadwal = JadwalPeriksa::first();

        $janjis = [
            [
                'id_pasien'=>$pasien->id,
                'id_jadwal_periksa'=>$jadwal->id,
                'keluhan'=>'batuk',
                'no_antrian'=>'1'
            ],
            [
                'id_pasien'=>$pasien->id,
                'id_jadwal_periksa'=>$jadwal->id,
                'keluhan'=>'pilek',
                'no_antrian'=>'2'
            ]
        ];

        foreach($janjis as $janji) {
            JanjiPeriksa::create($janji);
        }
    }
}
