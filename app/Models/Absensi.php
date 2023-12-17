<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensis';
    protected $guarded = [
        'id',
    ];

    protected $with = [
        'user'
    ];

    public function masuks()
    {
        return $this->hasMany(Masuk::class);
    }

    public function pulangs()
    {
        return $this->hasMany(Pulang::class);
    }

    public function siang1s()
    {
        return $this->hasMany(Siang1::class);
    }

    public function siang2s()
    {
        return $this->hasMany(Siang2::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getAbsenByUserid($userid)
    {
        return DB::table($this->table . ' as a')
            ->where('a.sts', '1')
            ->whereDate('a.tanggal', date('Y-m-d'))
            ->where('a.user_id', $userid)
            ->select('a.*')
            ->first();
    }

    public function getAbsenPulangByUserid($userid)
    {
        return DB::table($this->table . ' as a')
            ->join('pulangs as p', 'a.id', '=', 'p.absensi_id')
            ->where('p.sts', '1')
            ->where('a.sts', '1')
            ->whereDate('a.tanggal', date('Y-m-d'))
            ->where('a.user_id', $userid)
            ->select('p.*')
            ->first();
    }
    public function getAbsenMasukByUserid($userid)
    {
        return DB::table($this->table . ' as a')
            ->join('masuks as m', 'a.id', '=', 'm.absensi_id')
            ->where('m.sts', '1')
            ->where('a.sts', '1')
            ->whereDate('a.tanggal', date('Y-m-d'))
            ->where('a.user_id', $userid)
            ->select('m.*')
            ->first();
    }

    public function getAbsenSiangSatuByUserid($userid)
    {
        return DB::table($this->table . ' as a')
            ->join('siang1s as s', 'a.id', '=', 's.absensi_id')
            ->where('s.sts', '1')
            ->where('a.sts', '1')
            ->whereDate('a.tanggal', date('Y-m-d'))
            ->where('a.user_id', $userid)
            ->select('s.*')
            ->first();
    }

    public function getAbsenSiangDuaByUserid($userid)
    {
        return DB::table($this->table . ' as a')
            ->join('siang2s as s', 'a.id', '=', 's.absensi_id')
            ->where('s.sts', '1')
            ->where('a.sts', '1')
            ->whereDate('a.tanggal', date('Y-m-d'))
            ->where('a.user_id', $userid)
            ->select('s.*')
            ->first();
    }

    public function getAbsenByTglAndUserid($datenow, $user_id)
    {
        return DB::table($this->table . ' as a')
            ->leftJoin('siang2s as ss', function ($join) {
                $join->on('a.id', '=', 'ss.absensi_id')->where('ss.sts', '1');
            })
            ->leftJoin('masuks as m', function ($join) {
                $join->on('a.id', '=', 'm.absensi_id')->where('m.sts', '1');
            })
            ->leftJoin('siang1s as s', function ($join) {
                $join->on('a.id', '=', 's.absensi_id')->where('s.sts', '1');
            })
            ->leftJoin('pulangs as p', function ($join) {
                $join->on('a.id', '=', 'p.absensi_id')->where('p.sts', '1');
            })
            ->where('a.sts', '1')
            ->whereDate('a.tanggal', $datenow)
            ->where('a.user_id', $user_id)
            ->select(
                DB::raw('COALESCE(m.jam_masuk, "-") as jam_masuk'),
                DB::raw('COALESCE(s.jam_siang, "-") as jam_siang'),
                DB::raw('COALESCE(ss.jam_siang2, "-") as jam_siang2'),
                DB::raw('COALESCE(p.jam_pulang, "-") as jam_pulang')
            )
            ->first();
    }
}
