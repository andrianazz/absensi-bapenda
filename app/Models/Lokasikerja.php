<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lokasikerja extends Model
{
    protected $table = 'lokasikerja';
    protected $guarded = ['id'];
    public $timestamps = false;


    function getLokasiKerjaById($id)
    {
        return DB::table($this->table . ' as lk')
            ->where('lk.sts', '1')
            ->where('lk.id', $id)
            ->select('lk.*')
            ->first();
    }
}
