<?php

namespace Database\Seeders;

use App\Models\UnitKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        UnitKerja::create([
            'nama_unit_kerja' => 'UPT 1',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'UPT2 2',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'UPT2 3',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'UPT2 4',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'UPT2 5',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'Security',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'Kebersihan',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'Sekretariat (Teknisi Kantor)',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'Sekretariat',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'Sekretariat (Umum)',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'Sekretariat (Keuangan)',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'Sekretariat (Pelayanan Informasi)',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'Driver',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'Pajak Daerah 1',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'Pajak Daerah 1 (Pelayanan)',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'Pajak Daerah 2',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'Pajak Daerah 2 (Pelayanan)',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'P3D',
        ]);

        UnitKerja::create([
            'nama_unit_kerja' => 'Pengedalian Pajak Daerah',
        ]);
    }
}
