<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $with = [
        'unitKerja'
    ];

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }

    public function absensi()
    {
        return $this->belongsTo(Absensi::class);
    }

    public static function storeImage($file, $nik)
    {
        // $imageName = time() . '.' . $file->getClientOriginalExtension();
        $imageName = $nik . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $imageName);

        $user = User::where('nik', $nik)->first();
        $user->imageUrl = $imageName;

        // $image->path = 'public/images/' . $imageName;
        $user->save();

        return $user;
    }

    function getUserById($id)
    {
        return DB::table('users as u')
            ->join('unit_kerjas as uk', 'u.unit_kerja_id', '=', 'uk.id')
            ->where('u.sts', '1')
            ->where('u.id', $id)
            ->select('u.*', 'uk.nama_unit_kerja')
            ->first();
    }
}
