<?php

namespace App\Services;

use App\Models\ReadingSession;
use App\Models\UserBook;

class ReadingSessionService
{
    // Obtener las sesiones de lectura de un usuario.
    public function getAll(int $userId)
    {
        return ReadingSession::with('userBook.book')
            ->whereHas('userBook', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();
    }

    // Registrar una sesión de lectura.
    public function create(int $userId, array $data): ReadingSession
    {
        // Comprobar que el libro pertenece al usuario.
        $userBook = UserBook::where('user_id', $userId)
            ->with('book')
            ->findOrFail($data['user_book_id']);

        // Calcular las páginas leídas anteriormente.
        $pagesRead = ReadingSession::where('user_book_id', $userBook->id)
            ->sum('pages_read');

        // Comprobar que no se supera el total de páginas del libro.
        if ($pagesRead + $data['pages_read'] > $userBook->book->total_pages) {
            abort(409, 'El número de páginas leídas supera el total del libro.');
        }

        // Crear la sesión de lectura.
        return ReadingSession::create($data);
    }
}
