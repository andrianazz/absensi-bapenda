<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

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
}
