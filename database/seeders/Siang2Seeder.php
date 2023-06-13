<?php

namespace Database\Seeders;

use App\Models\Siang2;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Siang2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Siang2::create([
            'absensi_id' => '1',
            'jam_siang2' => '13:00',
            'long' => '123',
            'lang' => '123',
            'radius' => '123',
            'status' => 'Di dalam Area',
        ]);
    }
}
