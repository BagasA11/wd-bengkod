<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

// relationships
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JanjiPeriksa extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'keluhan',
        'no_antrian',
        'id_pasien',
        'id_jadwal_periksa'
    ];

    // get queue number
    public function getQueueNumber($id_jadwal) {
        $number = DB::table('janji_periksas')->where('id_jadwal_periksa', '=', $id_jadwal)->count();
        return $number;
    }

     // one to one
    public function periksa(){
        return $this->hasOne(Periksa::class, 'id_janji_periksa');
    }

    // Manny to One
    // same with Bellongs TO
    public function user() {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    public function jadwal_periksas(){
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal_periksa');
    }
}
