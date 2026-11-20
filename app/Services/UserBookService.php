<?php

namespace App\Services;

use App\Models\UserBook;

class UserBookService
{
    // Obtener los libros de un usuario.
    public function getAll(int $userId)
    {
        return UserBook::with('book')
            ->where('user_id', $userId)
            ->get();
    }

    // Obtener un libro de la biblioteca de un usuario.
    public function getById(int $userId, int $id): UserBook
    {
        return UserBook::with('book')
            ->where('user_id', $userId)
            ->findOrFail($id);
    }

    // Añadir un libro a la biblioteca de un usuario.
    public function create(int $userId, array $data): UserBook
    {
        // Comprobar si el libro ya está en la biblioteca.
        $exists = UserBook::where('user_id', $userId)
            ->where('book_id', $data['book_id'])
            ->exists();

        if ($exists) {
            abort(409, 'Este libro ya está en tu biblioteca.');
        }

        // Asignar el usuario autenticado.
        $data['user_id'] = $userId;

        return UserBook::create($data);
    }

    // Actualizar un libro de la biblioteca de un usuario.
    public function update(int $userId, int $id, array $data): UserBook
    {
        $userBook = UserBook::where('user_id', $userId)
            ->findOrFail($id);

        $userBook->update($data);

        return $userBook;
    }

    // Eliminar un libro de la biblioteca de un usuario.
    public function delete(int $userId, int $id): void
    {
        $userBook = UserBook::where('user_id', $userId)
            ->findOrFail($id);

        $userBook->delete();
    }
}
