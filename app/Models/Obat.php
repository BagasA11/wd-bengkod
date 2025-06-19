<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// relationships
use Illuminate\Database\Eloquent\Relations\HasMany;

class Obat extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    // use HasFactory;
    protected $fillable = [
        'nama_obat',
        'kemasan',
        'harga'
    ];

    public function detail_periksas(){
        return $this->hasMany(DetailPeriksa::class, 'id_obat');
    }
}
