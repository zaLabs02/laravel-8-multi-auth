<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;
use App\Models\User;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'username' => 'admin',
               'name'=>'ini akun Admin',
               'email'=>'admin@example.com',
                'level'=>'admin',
               'password'=> bcrypt('123456'),
            ],
            [
                'username' => 'user',
               'name'=>'ini akun User (non admin)',
               'email'=>'user@example.com',
                'level'=>'editor',
               'password'=> bcrypt('123456'),
            ],
        ];

        $pegawai = [
            [
                'username' => 'editor',
               'name'=>'ini akun Editor (pegawai)',
               'email'=>'admin@example.com',
                'level'=>'editor',
               'password'=> bcrypt('123456'),
            ],
            [
                'username' => 'QA',
               'name'=>'ini akun QA (pegawai)',
               'email'=>'user@example.com',
                'level'=>'QA',
               'password'=> bcrypt('123456'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
        foreach ($pegawai as $key => $value) {
            Pegawai::create($value);
        }
    }
}
