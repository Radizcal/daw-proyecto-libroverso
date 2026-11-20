<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReadingSessionRequest;
use App\Services\ReadingSessionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReadingSessionController extends Controller
{
    protected ReadingSessionService $readingSessionService;

    public function __construct(ReadingSessionService $readingSessionService)
    {
        $this->readingSessionService = $readingSessionService;
    }

    // Obtener las sesiones de lectura del usuario.
    public function index(Request $request): JsonResponse
    {
        $readingSessions = $this->readingSessionService->getAll(
            $request->user()->id
        );

        return response()->json($readingSessions, 200);
    }

    // Registrar una sesión de lectura.
    public function store(StoreReadingSessionRequest $request): JsonResponse
    {
        $readingSession = $this->readingSessionService->create(
            $request->user()->id,
            $request->validated()
        );

        return response()->json($readingSession, 201);
    }
}
