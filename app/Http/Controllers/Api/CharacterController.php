<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CharacterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    protected CharacterService $characterService;

    public function __construct(CharacterService $characterService)
    {
        $this->characterService = $characterService;
    }

    // Obtener el personaje del usuario autenticado.
    public function show(Request $request): JsonResponse
    {
        $character = $this->characterService->getByUserId(
            $request->user()->id
        );

        return response()->json($character, 200);
    }
}
