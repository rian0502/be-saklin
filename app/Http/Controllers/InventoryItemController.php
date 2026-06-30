<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInventoryItemRequest;
use App\Http\Requests\UpdateInventoryItemRequest;
use App\Http\Resources\InventoryItemResource;
use App\Models\InventoryItem;

class InventoryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = InventoryItem::query()
            ->when(! request()->user()->hasRole('owner'), function ($q) {
                $q->where('outlet_id', request()->user()->outlet_id);
            })
            ->latest()
            ->paginate(15);

        return InventoryItemResource::collection($items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryItemRequest $request)
    {
        $item = InventoryItem::create($request->validated());

        return (new InventoryItemResource($item))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryItem $item)
    {
        return new InventoryItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryItemRequest $request, InventoryItem $item)
    {
        $item->update($request->validated());

        return new InventoryItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryItem $item)
    {
        $item->delete();

        return response()->json(['message' => 'Item berhasil dihapus.']);
    }
}
