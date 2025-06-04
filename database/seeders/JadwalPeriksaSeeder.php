<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

Use App\Models\User;
Use App\Models\JadwalPeriksa;

class JadwalPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $dokter = User::where('role', 'dokter')->first();
        $jadwals = [
            [
                'id_dokter'=>$dokter->id,
                'hari'=>'senin',
                'jam_mulai'=>'08:00:00',
                'jam_selesai'=>'12:00:00',
                'status'=>true
            ],
            [
                'id_dokter'=>$dokter->id,
                'hari'=>'senin',
                'jam_mulai'=>'12:00:00',
                'jam_selesai'=>'2:00:00',
                'status'=>true
            ]
        ];

        foreach ($jadwals as $jadwal) {
            JadwalPeriksa::create($jadwal);
        }
    }
}
