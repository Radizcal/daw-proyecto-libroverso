<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CosmeticItemAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_cosmetic_items(): void
    {
        $response = $this->getJson('/api/v1/cosmetic-items');

        $response->assertStatus(401)
            ->assertHeader('Content-Type', 'application/problem+json');
    }
}
