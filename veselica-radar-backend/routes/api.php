<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UnauthorizedController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use Illuminate\Support\Facades\Validator;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);


Route::middleware(['waiterRole'])->group(function () {
    Route::get('/events', [EventsController::class, 'index']);
});

Route::middleware(['adminRole'])->group(function () {
    Route::get('/events/{id}', [EventsController::class, 'getById']);
});


Route::post('/events', [EventsController::class, 'store']);
Route::put('/events/{id}', [EventsController::class, 'update']);
Route::delete('/events/{id}', [EventsController::class, 'destroy']);


Route::get('/unauthorized', [UnauthorizedController::class, 'unauthorized'])->name('unauthorized');
