<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryItem extends Model
{
    protected $fillable = [
        'character_id',
        'cosmetic_item_id',
        'acquired_at',
        'is_equipped',
    ];

    protected function casts(): array
    {
        return [
            'acquired_at' => 'datetime',
            'is_equipped' => 'boolean',
        ];
    }

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    public function cosmeticItem(): BelongsTo
    {
        return $this->belongsTo(CosmeticItem::class);
    }
}
