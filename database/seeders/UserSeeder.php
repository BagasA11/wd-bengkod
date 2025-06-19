<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                'name'=>'user 1',
                'email' => 'user1@gmail.com',
                'password'=>'12345678',
                'nik'=>'0001',
                'no_hp'=>'6282112345678',
                'role'=>'pasien',
               
                'no_rm'=>'rm001',
                'address'=>'Semarang'
            ],
            [
                'name'=>'Dr.Abdul',
                'email' => 'abdul@clinic.com',
                'password'=>'12345678',
                'nik'=>'0001',
                'no_hp'=>'6282112345678',
                'role'=>'dokter',
              
             
                'address'=>'Semarang'
            ]
        ];

        foreach ($users as $u){
            User::create($u);
        }
    }
}
