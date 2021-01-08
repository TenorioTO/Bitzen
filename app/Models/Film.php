<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ator;
use App\Models\Category;
use App\Models\Avaliation;

class Film extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'titulo',
        'ano'
    ];

    public function categories(){
        return $this->belongsToMany(Category::class, 'film_categories');
    }

    public function actors() {
        return $this->belongsToMany(Ator::class, 'film_ators');
    }

    public function avaliation() {
        return $this->hasMany(Avaliation::class, 'film_id');
    }
}
