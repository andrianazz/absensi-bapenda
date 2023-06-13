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
        $this->call(UnitKerjaSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AbsensiSeeder::class);
        $this->call(MasukSeeder::class);
        $this->call(Siang1Seeder::class);
        $this->call(Siang2Seeder::class);
        $this->call(PulangSeeder::class);
    }
}
