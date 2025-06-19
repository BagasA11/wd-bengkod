<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// relationships
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Periksa extends Model
{
    use HasFactory;

    protected $fillable = [
        'catatan',
        'tgl_periksa',
        'biaya',
        'id_janji_periksa',
        'added_at'
    ];


    public $timestamps = false;

    // belong to

    // inverse of one to one
    public function janji_periksa(){
        return $this->belongsTo(JanjiPeriksa::class);
    }

    // one to manny
    // has manny
    public function detail_periksa(){
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }
}
