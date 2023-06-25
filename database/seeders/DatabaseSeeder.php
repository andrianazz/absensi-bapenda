<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UnitKerjaSeeder::class,
            UserSeeder::class,
            AbsensiSeeder::class,
            MasukSeeder::class,
            Siang1Seeder::class,
            Siang2Seeder::class,
            PulangSeeder::class,
        ]);
    }
}
