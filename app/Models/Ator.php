<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ator extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
    ];

    public function films(){
        return $this->belongsToMany(Film::class, 'film_ators');
    }
}
