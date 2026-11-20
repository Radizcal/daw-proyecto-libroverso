<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

class BookService
{
    // Obtener todos los libros.
    public function getAll(): Collection
    {
        return Book::all();
    }

    // Obtener un libro por su ID.
    public function getById(int $id): Book
    {
        return Book::findOrFail($id);
    }

    // Crear un libro.
    public function create(array $data): Book
    {
        return Book::create($data);
    }

    // Actualizar un libro.
    public function update(int $id, array $data): Book
    {
        $book = Book::findOrFail($id);

        $book->update($data);

        return $book;
    }

    // Eliminar un libro.
    public function delete(int $id): void
    {
        $book = Book::findOrFail($id);

        $book->delete();
    }
}
