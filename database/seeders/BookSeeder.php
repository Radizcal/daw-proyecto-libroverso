<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Don Quijote de la Mancha',
                'author' => 'Miguel de Cervantes',
                'total_pages' => 863,
            ],
            [
                'title' => 'Cien años de soledad',
                'author' => 'Gabriel García Márquez',
                'total_pages' => 471,
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'total_pages' => 328,
            ],
            [
                'title' => 'Orgullo y prejuicio',
                'author' => 'Jane Austen',
                'total_pages' => 432,
            ],
            [
                'title' => 'El principito',
                'author' => 'Antoine de Saint-Exupéry',
                'total_pages' => 96,
            ],
            [
                'title' => 'Harry Potter y la piedra filosofal',
                'author' => 'J. K. Rowling',
                'total_pages' => 256,
            ],
            [
                'title' => 'El señor de los anillos: La comunidad del anillo',
                'author' => 'J. R. R. Tolkien',
                'total_pages' => 576,
            ],
            [
                'title' => 'Crónica de una muerte anunciada',
                'author' => 'Gabriel García Márquez',
                'total_pages' => 144,
            ],
            [
                'title' => 'Los juegos del hambre',
                'author' => 'Suzanne Collins',
                'total_pages' => 374,
            ],
            [
                'title' => 'La sombra del viento',
                'author' => 'Carlos Ruiz Zafón',
                'total_pages' => 576,
            ],
        ];

        foreach ($books as $book) {
            DB::table('books')->updateOrInsert(
                ['title' => $book['title']],
                [
                    'author' => $book['author'],
                    'total_pages' => $book['total_pages'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
