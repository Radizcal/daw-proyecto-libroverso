<?php

namespace App\Services;

use App\Models\CosmeticItem;

class CosmeticItemService
{
    // Obtener todos los objetos cosméticos.
    public function getAll()
    {
        return CosmeticItem::all();
    }
}
