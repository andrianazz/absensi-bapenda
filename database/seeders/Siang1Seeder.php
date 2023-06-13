<?php

namespace Database\Seeders;

use App\Models\Siang1;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Siang1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Siang1::create([
            'absensi_id' => '1',
            'jam_siang' => '12:00',
            'long' => '123',
            'lang' => '123',
            'radius' => '123',
            'status' => 'Di dalam Area',
        ]);
    }
}
