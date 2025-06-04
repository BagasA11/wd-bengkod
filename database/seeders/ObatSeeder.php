<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Obat;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $obats = [
            [
                'nama_obat'=>'Paracetamol',
                'kemasan'=>'tablet',
                'harga'=>5000,
            ],
            [
                'nama_obat'=>'Salbutamol',
                'kemasan'=>'tablet',
                'harga'=>7000,
            ]
        ];

        foreach ($obats as $o){
            Obat::create($o);
        }
    }
}
