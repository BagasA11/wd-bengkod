<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\JanjiPeriksa;
use App\Models\Periksa;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $janji = JanjiPeriksa::first();
        $data = [
            'catatan'=>'jangan minum es',
            'id_janji_periksa'=>$janji->id,
            'tgl_periksa'=>now(),
            'biaya'=>75000,
            'added_at'=>now()
        ];

        Periksa::create($data);
    }
}
