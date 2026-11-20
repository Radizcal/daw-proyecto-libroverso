<?php

namespace Tests\Feature;

use App\Models\Character;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CharacterAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_only_access_their_own_character(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $character1 = Character::create([
            'user_id' => $user1->id,
            'level' => 5,
            'experience' => 100,
            'coins' => 200,
        ]);

        Character::create([
            'user_id' => $user2->id,
            'level' => 10,
            'experience' => 500,
            'coins' => 1000,
        ]);

        $response = $this->actingAs($user1)
            ->getJson('/api/v1/character');

        $response->assertStatus(200)
            ->assertJsonPath('id', $character1->id)
            ->assertJsonPath('user_id', $user1->id)
            ->assertJsonPath('level', 5)
            ->assertJsonPath('coins', 200);
    }
}
