<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMachineTypeRequest;
use App\Http\Requests\UpdateMachineTypeRequest;
use App\Http\Resources\MachineTypeResource;
use App\Models\MachineType;

class MachineTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MachineTypeResource::collection(MachineType::latest()->paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMachineTypeRequest $request)
    {
        $machineType = MachineType::create($request->validated());

        return (new MachineTypeResource($machineType))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MachineType $machineType)
    {
        return new MachineTypeResource($machineType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMachineTypeRequest $request, MachineType $machineType)
    {
        $machineType->update($request->validated());

        return new MachineTypeResource($machineType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MachineType $machineType)
    {
        $machineType->delete();

        return response()->json(['message' => 'Machine type berhasil dihapus.']);
    }
}
