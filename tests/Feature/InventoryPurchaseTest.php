<?php

namespace Tests\Feature;

use App\Models\Character;
use App\Models\CosmeticItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryPurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_purchase_a_cosmetic_item(): void
    {
        $user = User::factory()->create();

        Character::create([
            'user_id' => $user->id,
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

        $response = $this->actingAs($user)
            ->postJson('/api/v1/inventory', [
                'cosmetic_item_id' => $cosmeticItem->id,
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('cosmetic_item_id', $cosmeticItem->id)
            ->assertJsonPath('is_equipped', false);

        $this->assertDatabaseHas('characters', [
            'user_id' => $user->id,
            'coins' => 50,
        ]);

        $this->assertDatabaseHas('inventory_items', [
            'character_id' => $user->character->id,
            'cosmetic_item_id' => $cosmeticItem->id,
            'is_equipped' => false,
        ]);
    }

    public function test_user_cannot_purchase_an_item_twice(): void
    {
        $user = User::factory()->create();

        $character = Character::create([
            'user_id' => $user->id,
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

        $character->inventoryItems()->create([
            'cosmetic_item_id' => $cosmeticItem->id,
            'acquired_at' => now(),
            'is_equipped' => false,
        ]);

        $response = $this->actingAs($user)
            ->postJson('/api/v1/inventory', [
                'cosmetic_item_id' => $cosmeticItem->id,
            ]);

        $response->assertStatus(409)
            ->assertHeader('Content-Type', 'application/problem+json');

        $this->assertDatabaseHas('characters', [
            'user_id' => $user->id,
            'coins' => 100,
        ]);

        $this->assertDatabaseCount('inventory_items', 1);
    }

    public function test_user_cannot_purchase_an_item_without_enough_coins(): void
    {
        $user = User::factory()->create();

        Character::create([
            'user_id' => $user->id,
            'level' => 1,
            'experience' => 0,
            'coins' => 20,
        ]);

        $cosmeticItem = CosmeticItem::create([
            'name' => 'Gafas de prueba',
            'description' => 'Objeto de prueba',
            'category' => 'accessory',
            'price' => 50,
        ]);

        $response = $this->actingAs($user)
            ->postJson('/api/v1/inventory', [
                'cosmetic_item_id' => $cosmeticItem->id,
            ]);

        $response->assertStatus(409)
            ->assertHeader('Content-Type', 'application/problem+json');

        $this->assertDatabaseHas('characters', [
            'user_id' => $user->id,
            'coins' => 20,
        ]);

        $this->assertDatabaseCount('inventory_items', 0);
    }

    public function test_user_cannot_purchase_a_nonexistent_item(): void
    {
        $user = User::factory()->create();

        Character::create([
            'user_id' => $user->id,
            'level' => 1,
            'experience' => 0,
            'coins' => 100,
        ]);

        $response = $this->actingAs($user)
            ->postJson('/api/v1/inventory', [
                'cosmetic_item_id' => 999,
            ]);

        $response->assertStatus(422)
            ->assertHeader('Content-Type', 'application/problem+json');

        $this->assertDatabaseHas('characters', [
            'user_id' => $user->id,
            'coins' => 100,
        ]);

        $this->assertDatabaseCount('inventory_items', 0);
    }

    public function test_user_cannot_purchase_without_item_id(): void
    {
        $user = User::factory()->create();

        Character::create([
            'user_id' => $user->id,
            'level' => 1,
            'experience' => 0,
            'coins' => 100,
        ]);

        $response = $this->actingAs($user)
            ->postJson('/api/v1/inventory', []);

        $response->assertStatus(422)
            ->assertHeader('Content-Type', 'application/problem+json');

        $this->assertDatabaseHas('characters', [
            'user_id' => $user->id,
            'coins' => 100,
        ]);

        $this->assertDatabaseCount('inventory_items', 0);
    }
}
