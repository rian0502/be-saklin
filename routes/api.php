<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\MachineTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::post('/mobile/login', [AuthController::class, 'loginMobile']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/mobile/logout', [AuthController::class, 'logoutMobile']);
    Route::get('/me', [AuthController::class, 'me']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('permission:outlets.view')->group(function () {
        Route::get('outlets', [OutletController::class, 'index']);
        Route::get('outlets/{outlet}', [OutletController::class, 'show']);
    });
    Route::middleware('permission:outlets.create')->post('outlets', [OutletController::class, 'store']);
    Route::middleware('permission:outlets.update')->match(['put', 'patch'], 'outlets/{outlet}', [OutletController::class, 'update']);
    Route::middleware('permission:outlets.delete')->delete('outlets/{outlet}', [OutletController::class, 'destroy']);

    Route::middleware('permission:machines.view')->group(function () {
        Route::get('machine-types', [MachineTypeController::class, 'index']);
        Route::get('machine-types/{machine_type}', [MachineTypeController::class, 'show']);
        Route::get('machines', [MachineController::class, 'index']);
        Route::get('machines/{machine}', [MachineController::class, 'show']);
    });
    Route::middleware('permission:machines.create')->group(function () {
        Route::post('machine-types', [MachineTypeController::class, 'store']);
        Route::post('machines', [MachineController::class, 'store']);
    });
    Route::middleware('permission:machines.update')->group(function () {
        Route::match(['put', 'patch'], 'machine-types/{machine_type}', [MachineTypeController::class, 'update']);
        Route::match(['put', 'patch'], 'machines/{machine}', [MachineController::class, 'update']);
        Route::patch('machines/{machine}/status', [MachineController::class, 'updateStatus']);
    });
    Route::middleware('permission:machines.delete')->group(function () {
        Route::delete('machine-types/{machine_type}', [MachineTypeController::class, 'destroy']);
        Route::delete('machines/{machine}', [MachineController::class, 'destroy']);
    });

    Route::middleware('permission:services.view')->group(function () {
        Route::get('services', [ServiceController::class, 'index']);
        Route::get('services/{service}', [ServiceController::class, 'show']);
    });
    Route::middleware('permission:services.create')->post('services', [ServiceController::class, 'store']);
    Route::middleware('permission:services.update')->match(['put', 'patch'], 'services/{service}', [ServiceController::class, 'update']);
    Route::middleware('permission:services.delete')->delete('services/{service}', [ServiceController::class, 'destroy']);

    Route::middleware('permission:inventory.view')->group(function () {
        Route::get('inventory-items', [InventoryItemController::class, 'index']);
        Route::get('inventory-items/{inventory_item}', [InventoryItemController::class, 'show']);
    });
    Route::middleware('permission:inventory.create')->post('inventory-items', [InventoryItemController::class, 'store']);
    Route::middleware('permission:inventory.update')->match(['put', 'patch'], 'inventory-items/{inventory_item}', [InventoryItemController::class, 'update']);
    Route::middleware('permission:inventory.delete')->delete('inventory-items/{inventory_item}', [InventoryItemController::class, 'destroy']);

    Route::middleware('permission:customers.view')->group(function () {
        Route::get('customers', [CustomerController::class, 'index']);
        Route::get('customers/{customer}', [CustomerController::class, 'show']);
    });
    Route::middleware('permission:customers.create')->post('customers', [CustomerController::class, 'store']);
    Route::middleware('permission:customers.update')->match(['put', 'patch'], 'customers/{customer}', [CustomerController::class, 'update']);
    Route::middleware('permission:customers.delete')->delete('customers/{customer}', [CustomerController::class, 'destroy']);

});

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('permission:orders.view')->group(function () {
        Route::get('orders', [OrderController::class, 'index']);
        Route::get('orders/{order}', [OrderController::class, 'show']);
        Route::get('orders/{order}/payments', [PaymentController::class, 'index']);
    });

    Route::middleware('permission:orders.create')->group(function () {
        Route::post('orders', [OrderController::class, 'store']);
        Route::post('orders/{order}/details', [OrderDetailController::class, 'store']);
    });

    Route::middleware('permission:orders.update')->patch('orders/{order}/status', [OrderController::class, 'updateStatus']);

    Route::middleware('permission:payments.create')->post('orders/{order}/payments', [PaymentController::class, 'store']);

});