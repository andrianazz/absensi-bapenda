<?php

namespace Database\Seeders;

use App\Models\User;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'nik' => '123456789',
            'nama' => 'Andrian Wahyu',
            'tempat_lahir' => 'Pekanbaru',
            'tanggal_lahir' => date('Y-m-d', strtotime('1999-08-23')),
            'jenis_kelamin' => 'Pria',
            'pendidikan' => 'S1',
            'agama' => 'Islam',
            'alamat' => 'Jl. Nelayan',
            'unit_kerja_id' => '8',
            'imageUrl' => '',
            'password' => Hash::make("admin"),
        ]);

        User::create([
            'nik' => '321',
            'nama' => 'Muhammad Saski',
            'tempat_lahir' => 'Pekanbaru',
            'tanggal_lahir' => date('Y-m-d', strtotime('2001-01-01')),
            'jenis_kelamin' => 'Pria',
            'pendidikan' => 'S1',
            'agama' => 'Islam',
            'alamat' => 'Jl. Pembangunan',
            'unit_kerja_id' => '1',
            'imageUrl' => '',
            'password' => Hash::make("321"),
        ]);

        //Make 10 User Random for Testing
        for ($i = 0; $i < 10; $i++) {
            $date = new DateTime();
            $date->modify('-' . rand(0, 365 * 30) . ' days');
            $randomDate = $date->format('Y-m-d');

            User::create([
                'nik' => rand(1000, 9999),
                'nama' => 'Orang Random ' . $i . '',
                'tempat_lahir' => 'Pekanbaru',
                'tanggal_lahir' => $randomDate,
                'jenis_kelamin' => 'Pria',
                'pendidikan' => 'S1',
                'agama' => 'Islam',
                'alamat' => 'Jl. Pembangunan',
                'unit_kerja_id' => '1',
                'imageUrl' => '',
                'password' => Hash::make("123456"),
            ]);
        }

        User::create([
            'nik' => '4321',
            'nama' => 'Orang Random',
            'tempat_lahir' => 'Pekanbaru',
            'tanggal_lahir' => date('Y-m-d', strtotime('2001-01-01')),
            'jenis_kelamin' => 'Pria',
            'pendidikan' => 'S1',
            'agama' => 'Islam',
            'alamat' => 'Jl. Pembangunan',
            'unit_kerja_id' => '21',
            'imageUrl' => '',
            'password' => Hash::make("4321"),
        ]);
    }
}
