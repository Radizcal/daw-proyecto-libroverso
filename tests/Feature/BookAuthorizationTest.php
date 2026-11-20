<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_regular_user_cannot_create_books(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $response = $this->actingAs($user)
            ->postJson('/api/v1/books', [
                'title' => 'Libro de prueba',
                'author' => 'Autor de prueba',
                'total_pages' => 250,
            ]);

        $response->assertStatus(403)
            ->assertHeader('Content-Type', 'application/problem+json');
    }

    public function test_admin_can_create_books(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)
            ->postJson('/api/v1/books', [
                'title' => 'Libro de prueba',
                'author' => 'Autor de prueba',
                'total_pages' => 250,
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('title', 'Libro de prueba')
            ->assertJsonPath('author', 'Autor de prueba');
    }

    public function test_regular_user_cannot_update_books(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $book = Book::create([
            'title' => 'Libro original',
            'author' => 'Autor original',
            'total_pages' => 250,
        ]);

        $response = $this->actingAs($user)
            ->putJson('/api/v1/books/'.$book->id, [
                'title' => 'Libro modificado',
            ]);

        $response->assertStatus(403)
            ->assertHeader('Content-Type', 'application/problem+json');

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Libro original',
        ]);
    }

    public function test_regular_user_cannot_delete_books(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $book = Book::create([
            'title' => 'Libro de prueba',
            'author' => 'Autor de prueba',
            'total_pages' => 250,
        ]);

        $response = $this->actingAs($user)
            ->deleteJson('/api/v1/books/'.$book->id);

        $response->assertStatus(403)
            ->assertHeader('Content-Type', 'application/problem+json');

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Libro de prueba',
        ]);
    }

    public function test_admin_can_update_books(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $book = Book::create([
            'title' => 'Libro original',
            'author' => 'Autor original',
            'total_pages' => 250,
        ]);

        $response = $this->actingAs($admin)
            ->putJson('/api/v1/books/'.$book->id, [
                'title' => 'Libro actualizado',
            ]);

        $response->assertStatus(200)
            ->assertJsonPath('title', 'Libro actualizado');

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Libro actualizado',
        ]);
    }

    public function test_admin_can_delete_books(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $book = Book::create([
            'title' => 'Libro de prueba',
            'author' => 'Autor de prueba',
            'total_pages' => 250,
        ]);

        $response = $this->actingAs($admin)
            ->deleteJson('/api/v1/books/'.$book->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
    }

    public function test_admin_cannot_create_a_book_with_invalid_data(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)
            ->postJson('/api/v1/books', []);

        $response->assertStatus(422)
            ->assertHeader('Content-Type', 'application/problem+json')
            ->assertJsonStructure([
                'type',
                'title',
                'status',
                'detail',
                'instance',
                'errors',
            ]);
    }

    public function test_admin_cannot_update_a_book_with_invalid_data(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $book = Book::create([
            'title' => 'Libro original',
            'author' => 'Autor original',
            'total_pages' => 250,
        ]);

        $response = $this->actingAs($admin)
            ->putJson('/api/v1/books/'.$book->id, [
                'title' => '',
            ]);

        $response->assertStatus(422)
            ->assertHeader('Content-Type', 'application/problem+json')
            ->assertJsonStructure([
                'type',
                'title',
                'status',
                'detail',
                'instance',
                'errors',
            ]);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Libro original',
        ]);
    }
}
