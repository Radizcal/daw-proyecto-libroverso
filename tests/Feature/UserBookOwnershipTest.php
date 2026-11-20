<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use App\Models\UserBook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserBookOwnershipTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_access_another_users_book(): void
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
            ->getJson('/api/v1/my-books/'.$userBook->id);

        $response->assertStatus(404)
            ->assertHeader('Content-Type', 'application/problem+json');
    }

    public function test_user_cannot_update_another_users_book(): void
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
            ->patchJson('/api/v1/my-books/'.$userBook->id, [
                'status' => 'paused',
            ]);

        $response->assertStatus(404)
            ->assertHeader('Content-Type', 'application/problem+json');
    }

    public function test_user_cannot_delete_another_users_book(): void
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
            ->deleteJson('/api/v1/my-books/'.$userBook->id);

        $response->assertStatus(404)
            ->assertHeader('Content-Type', 'application/problem+json');
    }
}
