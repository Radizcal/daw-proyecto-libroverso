<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\ReadingSession;
use App\Models\User;
use App\Models\UserBook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadingSessionPrivacyTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_see_another_users_reading_sessions(): void
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

        ReadingSession::create([
            'user_book_id' => $userBook->id,
            'pages_read' => 10,
            'read_at' => '2026-11-20',
        ]);

        $response = $this->actingAs($otherUser)
            ->getJson('/api/v1/reading-sessions');

        $response->assertStatus(200)
            ->assertExactJson([]);
    }
}
