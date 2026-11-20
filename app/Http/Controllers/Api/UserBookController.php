<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserBookRequest;
use App\Http\Requests\UpdateUserBookRequest;
use App\Services\UserBookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserBookController extends Controller
{
    protected UserBookService $userBookService;

    public function __construct(UserBookService $userBookService)
    {
        $this->userBookService = $userBookService;
    }

    // Obtener la biblioteca del usuario autenticado.
    public function index(Request $request): JsonResponse
    {
        $userBooks = $this->userBookService->getAll($request->user()->id);

        return response()->json($userBooks, 200);
    }

    // Obtener un libro de la biblioteca.
    public function show(Request $request, int $id): JsonResponse
    {
        $userBook = $this->userBookService->getById($request->user()->id, $id);

        return response()->json($userBook, 200);
    }

    // Añadir un libro a la biblioteca.
    public function store(StoreUserBookRequest $request): JsonResponse
    {
        $userBook = $this->userBookService->create(
            $request->user()->id,
            $request->validated()
        );

        return response()->json($userBook, 201);
    }

    // Actualizar un libro de la biblioteca.
    public function update(UpdateUserBookRequest $request, int $id): JsonResponse
    {
        $userBook = $this->userBookService->update(
            $request->user()->id,
            $id,
            $request->validated()
        );

        return response()->json($userBook, 200);
    }

    // Eliminar un libro de la biblioteca.
    public function destroy(Request $request, int $id): JsonResponse
    {
        $this->userBookService->delete($request->user()->id, $id);

        return response()->json(null, 204);
    }
}
