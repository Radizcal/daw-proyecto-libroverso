<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CosmeticItemService;
use Illuminate\Http\JsonResponse;

class CosmeticItemController extends Controller
{
    protected CosmeticItemService $cosmeticItemService;

    public function __construct(CosmeticItemService $cosmeticItemService)
    {
        $this->cosmeticItemService = $cosmeticItemService;
    }

    // Obtener el catálogo de objetos cosméticos.
    public function index(): JsonResponse
    {
        $cosmeticItems = $this->cosmeticItemService->getAll();

        return response()->json($cosmeticItems, 200);
    }
}
