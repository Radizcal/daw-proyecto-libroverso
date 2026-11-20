<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_inventory(): void
    {
        $response = $this->getJson('/api/v1/inventory');

        $response->assertStatus(401)
            ->assertHeader('Content-Type', 'application/problem+json');
    }
}
