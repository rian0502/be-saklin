<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\MachineTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('permission:manage-outlets')->group(function () {
        Route::apiResource('outlets', OutletController::class);
    });

    Route::middleware('permission:manage-machines')->group(function () {
        Route::apiResource('machine-types', MachineTypeController::class);
        Route::apiResource('machines', MachineController::class);
        Route::patch('machines/{machine}/status', [MachineController::class, 'updateStatus']);
    });

    Route::middleware('permission:manage-services')->group(function () {
        Route::apiResource('services', ServiceController::class);
    });

    Route::middleware('permission:manage-inventory')->group(function () {
        Route::apiResource('inventory-items', InventoryItemController::class);
    });

});

Route::middleware(['auth:sanctum', 'permission:create-orders'])->group(function () {
    Route::get('orders', [OrderController::class, 'index']);
    Route::post('orders', [OrderController::class, 'store']);
    Route::get('orders/{order}', [OrderController::class, 'show']);
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus']);
    Route::post('orders/{order}/details', [OrderDetailController::class, 'store']);

    Route::get('orders/{order}/payments', [PaymentController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:manage-payments'])->group(function () {
    Route::post('orders/{order}/payments', [PaymentController::class, 'store']);
});
