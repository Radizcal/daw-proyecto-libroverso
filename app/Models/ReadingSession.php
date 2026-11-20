<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReadingSession extends Model
{
    protected $fillable = [
        'user_book_id',
        'pages_read',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
        ];
    }

    public function userBook(): BelongsTo
    {
        return $this->belongsTo(UserBook::class);
    }
}
