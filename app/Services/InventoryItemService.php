<?php

namespace App\Services;

use App\Models\Character;
use App\Models\CosmeticItem;
use App\Models\InventoryItem;
use Illuminate\Support\Facades\DB;

class InventoryItemService
{
    // Obtener el inventario de un usuario.
    public function getAll(int $userId)
    {
        $character = Character::where('user_id', $userId)
            ->firstOrFail();

        return $character->inventoryItems()
            ->with('cosmeticItem')
            ->get();
    }

    // Comprar un objeto cosmético.
    public function purchase(int $userId, int $cosmeticItemId)
    {
        return DB::transaction(function () use ($userId, $cosmeticItemId) {

            // Buscar el personaje del usuario.
            $character = Character::where('user_id', $userId)
                ->lockForUpdate()
                ->firstOrFail();

            // Buscar el objeto cosmético.
            $cosmeticItem = CosmeticItem::findOrFail($cosmeticItemId);

            // Comprobar si el usuario ya tiene el objeto.
            $exists = $character->inventoryItems()
                ->where('cosmetic_item_id', $cosmeticItemId)
                ->exists();

            if ($exists) {
                abort(409, 'Ya tienes este objeto en tu inventario.');
            }

            // Comprobar si tiene suficientes monedas.
            if ($character->coins < $cosmeticItem->price) {
                abort(409, 'No tienes suficientes monedas.');
            }

            // Descontar las monedas.
            $character->coins -= $cosmeticItem->price;
            $character->save();

            // Añadir el objeto al inventario.
            return $character->inventoryItems()->create([
                'cosmetic_item_id' => $cosmeticItemId,
                'acquired_at' => now(),
                'is_equipped' => false,
            ]);
        });
    }

    // Equipar o desequipar un objeto.
    public function updateEquipment(int $userId, int $inventoryItemId, bool $isEquipped): InventoryItem
    {
        // Buscar el personaje del usuario.
        $character = Character::where('user_id', $userId)
            ->firstOrFail();

        // Buscar el objeto dentro de su inventario.
        $inventoryItem = $character->inventoryItems()
            ->findOrFail($inventoryItemId);

        // Actualizar su estado.
        $inventoryItem->is_equipped = $isEquipped;
        $inventoryItem->save();

        return $inventoryItem;
    }
}
