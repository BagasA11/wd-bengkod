<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Poli extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'nama_poli'
    ];

    public function dokters():HasMany{
        return $this->hasMany(User::class, 'poli_id');
    }

}
