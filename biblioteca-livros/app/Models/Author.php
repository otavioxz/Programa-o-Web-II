<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'biografia',
        'data_nascimento'
    ];

    protected $casts = [
        'data_nascimento' => 'date'
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
