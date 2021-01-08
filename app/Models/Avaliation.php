<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Film;
use App\Models\User;

class Avaliation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'film_id',
        'rate'
    ];

    public function film() {
        return $this->belongsTo(Film::class);
    }

    public function users() {
        return $this->belongsTo(User::class);
    }
}
