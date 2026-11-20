<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_books(): void
    {
        $response = $this->getJson('/api/v1/books');

        $response->assertStatus(401)
            ->assertHeader('Content-Type', 'application/problem+json');
    }

    public function test_authenticated_user_can_access_books(): void
    {
        $user = User::factory()->create();

        Book::create([
            'title' => 'Libro de prueba',
            'author' => 'Autor de prueba',
            'total_pages' => 250,
        ]);

        $response = $this->actingAs($user)
            ->getJson('/api/v1/books');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'title' => 'Libro de prueba',
                'author' => 'Autor de prueba',
            ]);
    }

    public function test_authenticated_user_can_access_a_specific_book(): void
    {
        $user = User::factory()->create();

        $book = Book::create([
            'title' => 'Libro de prueba',
            'author' => 'Autor de prueba',
            'total_pages' => 250,
        ]);

        $response = $this->actingAs($user)
            ->getJson('/api/v1/books/'.$book->id);

        $response->assertStatus(200)
            ->assertJsonPath('id', $book->id)
            ->assertJsonPath('title', 'Libro de prueba')
            ->assertJsonPath('author', 'Autor de prueba');
    }

    public function test_authenticated_user_cannot_access_a_nonexistent_book(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/v1/books/999');

        $response->assertStatus(404)
            ->assertHeader('Content-Type', 'application/problem+json');
    }
}
