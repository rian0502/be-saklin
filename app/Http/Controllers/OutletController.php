<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOutletRequest;
use App\Http\Requests\UpdateOutletRequest;
use App\Http\Resources\OutletResource;
use App\Models\Outlet;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $outlets = Outlet::query()
            ->when(! request()->user()->hasRole('owner'), function ($q) {
                $q->where('id', request()->user()->outlet_id);
            })
            ->latest()
            ->paginate(15);

        return OutletResource::collection($outlets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOutletRequest $request)
    {
        $outlet = Outlet::create($request->validated());

        return (new OutletResource($outlet))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Outlet $outlet)
    {
        return new OutletResource($outlet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOutletRequest $request, Outlet $outlet)
    {
        $outlet->update($request->validated());

        return new OutletResource($outlet);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outlet $outlet)
    {
        $outlet->delete();

        return response()->json(['message' => 'Outlet berhasil dihapus.']);
    }
}
