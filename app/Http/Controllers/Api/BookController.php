<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    protected BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    // Obtener todos los libros.
    public function index(): JsonResponse
    {
        $books = $this->bookService->getAll();

        return response()->json($books, 200);
    }

    // Obtener un libro concreto.
    public function show(int $id): JsonResponse
    {
        $book = $this->bookService->getById($id);

        return response()->json($book, 200);
    }

    // Crear un libro.
    public function store(StoreBookRequest $request): JsonResponse
    {
        $book = $this->bookService->create($request->validated());

        return response()->json($book, 201);
    }

    // Actualizar un libro.
    public function update(UpdateBookRequest $request, int $id): JsonResponse
    {
        $book = $this->bookService->update($id, $request->validated());

        return response()->json($book, 200);
    }

    // Eliminar un libro.
    public function destroy(int $id): JsonResponse
    {
        $this->bookService->delete($id);

        return response()->json(null, 204);
    }
}
