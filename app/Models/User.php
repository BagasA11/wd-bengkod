<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
// relationships
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'nik',
        'no_hp',
        'no_rm',
        'poli',
        'role'
    ];

    public function jadwal_periksas() {
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }

    public function janji_periksas() {
        return $this->hasMany(JanjiPeriksa::class, 'id_pasien');
    }

    public function no_rm(){
        $y = date('Y');
        $m = date('m');
        $queue = DB::table('users')->where('role', 'pasien')->count()+1;
        return $y.$m.strval($queue); //YYYYmmn
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'nik'
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
