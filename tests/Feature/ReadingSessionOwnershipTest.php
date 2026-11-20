<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use App\Models\UserBook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadingSessionOwnershipTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_create_reading_session_for_another_users_book(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();

        $book = Book::create([
            'title' => 'Libro privado',
            'author' => 'Autor de prueba',
            'total_pages' => 250,
        ]);

        $userBook = UserBook::create([
            'user_id' => $owner->id,
            'book_id' => $book->id,
            'status' => 'reading',
        ]);

        $response = $this->actingAs($otherUser)
            ->postJson('/api/v1/reading-sessions', [
                'user_book_id' => $userBook->id,
                'pages_read' => 10,
                'read_at' => '2026-11-20',
            ]);

        $response->assertStatus(404)
            ->assertHeader('Content-Type', 'application/problem+json');

        $this->assertDatabaseCount('reading_sessions', 0);
    }

    public function test_user_cannot_read_more_pages_than_the_book_contains(): void
    {
        $user = User::factory()->create();

        $book = Book::create([
            'title' => 'Libro de prueba',
            'author' => 'Autor de prueba',
            'total_pages' => 10,
        ]);

        $userBook = UserBook::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'status' => 'reading',
        ]);

        $response = $this->actingAs($user)
            ->postJson('/api/v1/reading-sessions', [
                'user_book_id' => $userBook->id,
                'pages_read' => 11,
                'read_at' => '2026-11-20',
            ]);

        $response->assertStatus(409)
            ->assertHeader('Content-Type', 'application/problem+json');

        $this->assertDatabaseCount('reading_sessions', 0);
    }
}
