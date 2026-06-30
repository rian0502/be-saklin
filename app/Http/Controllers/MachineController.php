<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMachineRequest;
use App\Http\Requests\UpdateMachineRequest;
use App\Http\Resources\MachineResource;
use App\Models\Machine;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $machines = Machine::query()
            ->when(! request()->user()->hasRole('owner'), function ($q) {
                $q->where('outlet_id', request()->user()->outlet_id);
            })
            ->with('machineType')
            ->latest()
            ->paginate(15);

        return MachineResource::collection($machines);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMachineRequest $request)
    {
        $machine = Machine::create($request->validated());

        return (new MachineResource($machine))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Machine $machine)
    {
        return new MachineResource($machine->load('machineType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMachineRequest $request, Machine $machine)
    {
        $machine->update($request->validated());

        return new MachineResource($machine);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Machine $machine)
    {
        $machine->delete();

        return response()->json(['message' => 'Machine berhasil dihapus.']);
    }

    public function updateStatus(Request $request, Machine $machine)
    {
        $request->validate(['status' => 'required|in:idle,running,maintenance,offline']);
        $machine->update(['status' => $request->status]);

        return new MachineResource($machine);
    }
}
