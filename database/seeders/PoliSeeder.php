<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Poli;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = [
            'gigi',
            'anak',
            'kulit',
            'umum'
        ];

        foreach ($polis as $p) {
            # code...
            Poli::create([
                'nama_poli'=>$p
            ]);
        }
        
    }
}
