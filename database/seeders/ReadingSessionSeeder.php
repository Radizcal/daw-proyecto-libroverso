<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReadingSessionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reading_sessions')->updateOrInsert(
            [
                'user_book_id' => DB::table('user_books')
                    ->where('user_id', DB::table('users')->where('email', 'user1@cifpaviles.es')->value('id'))
                    ->where('book_id', DB::table('books')->where('title', 'Don Quijote de la Mancha')->value('id'))
                    ->value('id'),
                'read_at' => '2026-01-11 18:00:00',
            ],
            [
                'pages_read' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('reading_sessions')->updateOrInsert(
            [
                'user_book_id' => DB::table('user_books')
                    ->where('user_id', DB::table('users')->where('email', 'user1@cifpaviles.es')->value('id'))
                    ->where('book_id', DB::table('books')->where('title', 'Don Quijote de la Mancha')->value('id'))
                    ->value('id'),
                'read_at' => '2026-01-12 19:00:00',
            ],
            [
                'pages_read' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('reading_sessions')->updateOrInsert(
            [
                'user_book_id' => DB::table('user_books')
                    ->where('user_id', DB::table('users')->where('email', 'user1@cifpaviles.es')->value('id'))
                    ->where('book_id', DB::table('books')->where('title', '1984')->value('id'))
                    ->value('id'),
                'read_at' => '2026-02-05 17:30:00',
            ],
            [
                'pages_read' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('reading_sessions')->updateOrInsert(
            [
                'user_book_id' => DB::table('user_books')
                    ->where('user_id', DB::table('users')->where('email', 'user2@cifpaviles.es')->value('id'))
                    ->where('book_id', DB::table('books')->where('title', 'Cien años de soledad')->value('id'))
                    ->value('id'),
                'read_at' => '2026-03-06 20:00:00',
            ],
            [
                'pages_read' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('reading_sessions')->updateOrInsert(
            [
                'user_book_id' => DB::table('user_books')
                    ->where('user_id', DB::table('users')->where('email', 'user2@cifpaviles.es')->value('id'))
                    ->where('book_id', DB::table('books')->where('title', 'El principito')->value('id'))
                    ->value('id'),
                'read_at' => '2026-01-16 18:00:00',
            ],
            [
                'pages_read' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('reading_sessions')->updateOrInsert(
            [
                'user_book_id' => DB::table('user_books')
                    ->where('user_id', DB::table('users')->where('email', 'user3@cifpaviles.es')->value('id'))
                    ->where('book_id', DB::table('books')->where('title', 'Orgullo y prejuicio')->value('id'))
                    ->value('id'),
                'read_at' => '2026-04-02 17:00:00',
            ],
            [
                'pages_read' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('reading_sessions')->updateOrInsert(
            [
                'user_book_id' => DB::table('user_books')
                    ->where('user_id', DB::table('users')->where('email', 'user3@cifpaviles.es')->value('id'))
                    ->where('book_id', DB::table('books')->where('title', '1984')->value('id'))
                    ->value('id'),
                'read_at' => '2026-02-12 18:00:00',
            ],
            [
                'pages_read' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('reading_sessions')->updateOrInsert(
            [
                'user_book_id' => DB::table('user_books')
                    ->where('user_id', DB::table('users')->where('email', 'user4@cifpaviles.es')->value('id'))
                    ->where('book_id', DB::table('books')->where('title', 'Harry Potter y la piedra filosofal')->value('id'))
                    ->value('id'),
                'read_at' => '2026-05-12 18:00:00',
            ],
            [
                'pages_read' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('reading_sessions')->updateOrInsert(
            [
                'user_book_id' => DB::table('user_books')
                    ->where('user_id', DB::table('users')->where('email', 'user5@cifpaviles.es')->value('id'))
                    ->where('book_id', DB::table('books')->where('title', 'El señor de los anillos: La comunidad del anillo')->value('id'))
                    ->value('id'),
                'read_at' => '2026-02-22 19:00:00',
            ],
            [
                'pages_read' => 55,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('reading_sessions')->updateOrInsert(
            [
                'user_book_id' => DB::table('user_books')
                    ->where('user_id', DB::table('users')->where('email', 'user6@cifpaviles.es')->value('id'))
                    ->where('book_id', DB::table('books')->where('title', 'Crónica de una muerte anunciada')->value('id'))
                    ->value('id'),
                'read_at' => '2026-03-21 18:00:00',
            ],
            [
                'pages_read' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('reading_sessions')->updateOrInsert(
            [
                'user_book_id' => DB::table('user_books')
                    ->where('user_id', DB::table('users')->where('email', 'user7@cifpaviles.es')->value('id'))
                    ->where('book_id', DB::table('books')->where('title', 'Los juegos del hambre')->value('id'))
                    ->value('id'),
                'read_at' => '2026-06-05 18:00:00',
            ],
            [
                'pages_read' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('reading_sessions')->updateOrInsert(
            [
                'user_book_id' => DB::table('user_books')
                    ->where('user_id', DB::table('users')->where('email', 'user8@cifpaviles.es')->value('id'))
                    ->where('book_id', DB::table('books')->where('title', 'La sombra del viento')->value('id'))
                    ->value('id'),
                'read_at' => '2026-07-03 19:00:00',
            ],
            [
                'pages_read' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
