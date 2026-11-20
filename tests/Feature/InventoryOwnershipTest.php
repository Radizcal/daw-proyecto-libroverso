<?php

namespace Tests\Feature;

use App\Models\Character;
use App\Models\CosmeticItem;
use App\Models\InventoryItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryOwnershipTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_update_another_users_inventory_item(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();

        $character = Character::create([
            'user_id' => $owner->id,
            'level' => 1,
            'experience' => 0,
            'coins' => 100,
        ]);

        $cosmeticItem = CosmeticItem::create([
            'name' => 'Gafas de prueba',
            'description' => 'Objeto de prueba',
            'category' => 'accessory',
            'price' => 50,
        ]);

        $inventoryItem = InventoryItem::create([
            'character_id' => $character->id,
            'cosmetic_item_id' => $cosmeticItem->id,
            'acquired_at' => now(),
            'is_equipped' => true,
        ]);

        $response = $this->actingAs($otherUser)
            ->patchJson('/api/v1/inventory/'.$inventoryItem->id, [
                'is_equipped' => false,
            ]);

        $response->assertStatus(404)
            ->assertHeader('Content-Type', 'application/problem+json');

        $this->assertDatabaseHas('inventory_items', [
            'id' => $inventoryItem->id,
            'is_equipped' => true,
        ]);
    }

    public function test_user_cannot_see_another_users_inventory_items(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();

        $ownerCharacter = Character::create([
            'user_id' => $owner->id,
            'level' => 1,
            'experience' => 0,
            'coins' => 100,
        ]);

        Character::create([
            'user_id' => $otherUser->id,
            'level' => 1,
            'experience' => 0,
            'coins' => 100,
        ]);

        $cosmeticItem = CosmeticItem::create([
            'name' => 'Gafas de prueba',
            'description' => 'Objeto de prueba',
            'category' => 'accessory',
            'price' => 50,
        ]);

        InventoryItem::create([
            'character_id' => $ownerCharacter->id,
            'cosmetic_item_id' => $cosmeticItem->id,
            'acquired_at' => now(),
            'is_equipped' => false,
        ]);

        $response = $this->actingAs($otherUser)
            ->getJson('/api/v1/inventory');

        $response->assertStatus(200)
            ->assertExactJson([]);
    }
}
