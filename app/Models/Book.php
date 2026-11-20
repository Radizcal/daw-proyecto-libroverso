<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'total_pages',
    ];

    public function userBooks(): HasMany
    {
        return $this->hasMany(UserBook::class);
    }
}
