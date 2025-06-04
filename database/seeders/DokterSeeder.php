<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $dokters = [
            [
                'name' => 'Dr. Budi Santoso, Sp.PD',
                'email' => 'budi.santoso@klinik.com',
                'password' => 'dokter123',
                'role' => 'dokter',
                'address' => 'Jl. Pahlawan No. 123, Jakarta Selatan',
                'nik' => '3175062505800001',
                'no_hp' => '081234567890',
                'poli' => 'Penyakit Dalam',
            ],
            [
                'name' => 'Dr. Siti Rahayu, Sp.A',
                'email' => 'siti.rahayu@klinik.com',
                'password' => 'dokter123',
                'role' => 'dokter',
                'address' => 'Jl. Anggrek No. 45, Jakarta Pusat',
                'nik' => '3175064610790002',
                'no_hp' => '081234567891',
                'poli' => 'Anak',
            ],
            [
                'name' => 'Dr. Ahmad Wijaya, Sp.OG',
                'email' => 'ahmad.wijaya@klinik.com',
                'password' => 'dokter123',
                'role' => 'dokter',
                'address' => 'Jl. Melati No. 78, Jakarta Barat',
                'nik' => '3175061505780003',
                'no_hp' => '081234567892',
                'poli' => 'Kebidanan dan Kandungan',
            ],
            [
                'name' => 'Dr. Rina Putri, Sp.M',
                'email' => 'rina.putri@klinik.com',
                'password' => 'dokter123',
                'role' => 'dokter',
                'address' => 'Jl. Dahlia No. 32, Jakarta Timur',
                'nik' => '3175062708850004',
                'no_hp' => '081234567893',
                'poli' => 'Mata',
            ],
            [
                'name' => 'Dr. Doni Pratama, Sp.THT',
                'email' => 'doni.pratama@klinik.com',
                'password' => 'dokter123',
                'role' => 'dokter',
                'address' => 'Jl. Kenanga No. 56, Jakarta Utara',
                'nik' => '3175061002820005',
                'no_hp' => '081234567894',
                'poli' => 'THT',
            ],
        ];

        foreach ($dokters as $dokter) {
            User::create($dokter);
        }
    }
}
