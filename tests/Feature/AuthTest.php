<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'Origin' => 'http://localhost',
            'Referer' => 'http://localhost',
        ]);
    }

    public function test_user_can_login(): void
    {
        $user = User::factory()->create([
            'name' => 'testuser',
            'password' => 'password123',
        ]);

        $response = $this->postJson('/api/v1/login', [
            'name' => 'testuser',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('user.id', $user->id)
            ->assertJsonMissingPath('user.password');
    }

    public function test_user_cannot_login_with_invalid_credentials(): void
    {
        User::factory()->create([
            'name' => 'testuser',
            'password' => 'password123',
        ]);

        $response = $this->postJson('/api/v1/login', [
            'name' => 'testuser',
            'password' => 'incorrecta',
        ]);

        $response->assertStatus(401)
            ->assertHeader('Content-Type', 'application/problem+json');
    }

    public function test_user_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson('/api/v1/logout');

        $response->assertStatus(200);
    }
}
