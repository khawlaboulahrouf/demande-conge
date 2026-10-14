<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CongeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/conges', [CongeController::class, 'index']);
    Route::post('/conges', [CongeController::class, 'store']);

    Route::middleware('admin')->group(function () {
        Route::get('/admin/conges', [CongeController::class, 'all']);
        Route::patch('/admin/conges/{conge}/statut', [CongeController::class, 'updateStatut']);
    });
});