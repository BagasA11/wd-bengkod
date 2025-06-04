<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// relationships
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPeriksa extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'id_periksas',
        'id_obat'
    ];

    // manny to one
    // belongs to
    public function obat(){
        return $this->belongsTo(Obat::class, 'id_obat');
    }

    public function periksa(){
        return $this->belongsTo(Periksa::class, 'id_periksas');
    }

}
