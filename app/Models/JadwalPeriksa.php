<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// relationships
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPeriksa extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'hari',
        'id_dokter',
        'jam_mulai',
        'jam_selesai',
        'status'
    ];

    // One to Manny
    public function janji_periksas(){
        return $this->hasMany(JanjiPeriksa::class, 'id_jadwal_periksa');
    }
    
    // Manny to One
    public function dokter() {
        return $this->belongsTo(User::class);
    }

}
