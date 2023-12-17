<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jam_absen extends Model
{
    protected $table = 'jam_absen';
    protected $guarded = ['id'];
    public $timestamps = false;


    function getJamAbsenByJam($jam)
    {
        return DB::table($this->table . ' as ja')
            ->where('ja.sts', '1')
            ->whereRaw('? BETWEEN ja.jam_awal AND ja.jam_akhir', [$jam])
            ->select('ja.*')
            ->first();
    }
}
