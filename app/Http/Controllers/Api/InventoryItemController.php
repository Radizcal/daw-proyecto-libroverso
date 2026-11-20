<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateInventoryItemRequest;
use App\Services\InventoryItemService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    protected InventoryItemService $inventoryItemService;

    public function __construct(InventoryItemService $inventoryItemService)
    {
        $this->inventoryItemService = $inventoryItemService;
    }

    // Obtener el inventario del usuario autenticado.
    public function index(Request $request): JsonResponse
    {
        $inventoryItems = $this->inventoryItemService->getAll(
            $request->user()->id
        );

        return response()->json($inventoryItems, 200);
    }

    // Comprar un objeto cosmético.
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'cosmetic_item_id' => 'required|integer|exists:cosmetic_items,id',
        ], [
            'cosmetic_item_id.required' => 'Debes seleccionar un objeto.',
            'cosmetic_item_id.integer' => 'El identificador del objeto debe ser un número entero.',
            'cosmetic_item_id.exists' => 'El objeto seleccionado no existe.',
        ]);

        $inventoryItem = $this->inventoryItemService->purchase(
            $request->user()->id,
            $data['cosmetic_item_id']
        );

        return response()->json($inventoryItem, 201);
    }

    // Equipar o desequipar un objeto.
    public function update(UpdateInventoryItemRequest $request, int $id): JsonResponse
    {
        $inventoryItem = $this->inventoryItemService->updateEquipment(
            $request->user()->id,
            $id,
            $request->validated()['is_equipped']
        );

        return response()->json($inventoryItem, 200);
    }
}
