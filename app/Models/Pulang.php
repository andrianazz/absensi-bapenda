<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pulang extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',

    ];

    protected $with = [
        'absensi'
    ];

    public function absensi()
    {
        return $this->belongsTo(Absensi::class);
    }
}
