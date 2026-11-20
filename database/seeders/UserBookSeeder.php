<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserBookSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user1@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'Don Quijote de la Mancha')->value('id'),
            ],
            [
                'started_at' => '2026-01-10',
                'status' => 'reading',
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user1@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', '1984')->value('id'),
            ],
            [
                'started_at' => '2026-02-01',
                'status' => 'completed',
                'completed_at' => '2026-02-20',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user2@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'Cien años de soledad')->value('id'),
            ],
            [
                'started_at' => '2026-03-05',
                'status' => 'reading',
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user2@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'El principito')->value('id'),
            ],
            [
                'started_at' => '2026-01-15',
                'status' => 'completed',
                'completed_at' => '2026-01-18',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user3@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'Orgullo y prejuicio')->value('id'),
            ],
            [
                'started_at' => '2026-04-01',
                'status' => 'paused',
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user4@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'Harry Potter y la piedra filosofal')->value('id'),
            ],
            [
                'started_at' => '2026-05-10',
                'status' => 'reading',
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user5@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'El señor de los anillos: La comunidad del anillo')->value('id'),
            ],
            [
                'started_at' => '2026-02-12',
                'status' => 'reading',
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user6@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'Crónica de una muerte anunciada')->value('id'),
            ],
            [
                'started_at' => '2026-03-20',
                'status' => 'completed',
                'completed_at' => '2026-03-25',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user7@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'Los juegos del hambre')->value('id'),
            ],
            [
                'started_at' => '2026-06-01',
                'status' => 'reading',
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user8@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'La sombra del viento')->value('id'),
            ],
            [
                'started_at' => '2026-07-01',
                'status' => 'paused',
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user3@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', '1984')->value('id'),
            ],
            [
                'started_at' => '2026-02-10',
                'status' => 'completed',
                'completed_at' => '2026-03-01',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user4@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'El principito')->value('id'),
            ],
            [
                'started_at' => '2026-04-05',
                'status' => 'completed',
                'completed_at' => '2026-04-08',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user5@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'Harry Potter y la piedra filosofal')->value('id'),
            ],
            [
                'started_at' => '2026-05-15',
                'status' => 'reading',
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user6@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'Don Quijote de la Mancha')->value('id'),
            ],
            [
                'started_at' => '2026-01-20',
                'status' => 'paused',
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user7@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'Cien años de soledad')->value('id'),
            ],
            [
                'started_at' => '2026-03-12',
                'status' => 'reading',
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user8@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'Orgullo y prejuicio')->value('id'),
            ],
            [
                'started_at' => '2026-04-15',
                'status' => 'completed',
                'completed_at' => '2026-05-10',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user9@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'Los juegos del hambre')->value('id'),
            ],
            [
                'started_at' => '2026-06-10',
                'status' => 'reading',
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user9@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'La sombra del viento')->value('id'),
            ],
            [
                'started_at' => '2026-07-15',
                'status' => 'paused',
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user9@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'El señor de los anillos: La comunidad del anillo')->value('id'),
            ],
            [
                'started_at' => '2026-02-20',
                'status' => 'reading',
                'completed_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('user_books')->updateOrInsert(
            [
                'user_id' => DB::table('users')->where('email', 'user9@cifpaviles.es')->value('id'),
                'book_id' => DB::table('books')->where('title', 'Crónica de una muerte anunciada')->value('id'),
            ],
            [
                'started_at' => '2026-03-25',
                'status' => 'completed',
                'completed_at' => '2026-04-02',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
