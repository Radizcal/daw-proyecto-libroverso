<?php

namespace App\Services;

use App\Models\Character;

class CharacterService
{
    // Obtener el personaje de un usuario.
    public function getByUserId(int $userId): Character
    {
        return Character::where('user_id', $userId)
            ->with('inventoryItems')
            ->firstOrFail();
    }
}
