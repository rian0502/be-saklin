<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    try {
        Redis::set('status', 'Terkoneksi dengan Laravel 12!');
        $value = Redis::get('status');

        return response()->json([
            'status' => 'Sukses',
            'pesan' => 'Redis berjalan normal',
            'data' => $value,
        ]);
    } catch (Exception $e) {
        return response()->json([
            'status' => 'Gagal',
            'error' => $e->getMessage(),
        ], 500);
    }
});

Route::post('/web/login', [AuthController::class, 'login']);
Route::post('/web/logout', [AuthController::class, 'logout'])->middleware('auth');
