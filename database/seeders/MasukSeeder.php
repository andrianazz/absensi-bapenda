<?php

namespace Database\Seeders;

use App\Models\Masuk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Masuk::create([
            'absensi_id' => '1',
            'jam_masuk' => '05:00',
            'long' => '123',
            'lang' => '123',
            'radius' => '123',
            'status' => 'Di dalam Area',
        ]);
    }
}
