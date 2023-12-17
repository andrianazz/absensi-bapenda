<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unitlokasikerja extends Model
{
    protected $table = 'unitlokasikerja';
    protected $guarded = ['id'];
    public $timestamps = false;

    function getLokasiUnitKantorByUnitKerja($unitkerja_id)
    {
        return DB::table($this->table . ' as ulk')
            ->join('lokasikerja as lk', 'ulk.lokasikerja_id', '=', 'lk.id')
            ->where('ulk.sts', '1')
            ->where('lk.sts', '1')
            ->where('ulk.unitkerja_id', $unitkerja_id)
            ->select('ulk.*', 'lk.lan', 'lk.lat', 'lk.maxradius', 'lk.jns_lokasi')
            ->get();
    }
}
