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


Route::middleware(['adminRole'])->group(function () {
    Route::post('/events/{id}', [EventsController::class, 'getById']);
});

Route::get('/events', [EventsController::class, 'index']);
Route::post('/events', [EventsController::class, 'store']);
Route::put('/events/{id}', [EventsController::class, 'update']);
Route::delete('/events/{id}', [\App\Http\Controllers\EventsController::class, 'destroy']);

//USER

Route::get('/user', [\App\Http\Controllers\UserController::class, 'index']);

Route::middleware(['userRole'])->group(function () {
    Route::post('/user/{id}', [\App\Http\Controllers\UserController::class, 'getById']);
});
Route::post('/user', [\App\Http\Controllers\UserController::class, 'store']);
Route::put('/user/{id}', [\App\Http\Controllers\UserController::class, 'update']);
Route::delete('/user/{id}', [\App\Http\Controllers\UserController::class, 'destroy']);


//DRINK

Route::get('/drink', [\App\Http\Controllers\DrinkController::class, 'index']);

Route::get('/drink/{id}', [\App\Http\Controllers\DrinkController::class, 'getById']);
Route::post('/drink', [\App\Http\Controllers\DrinkController::class, 'store']);
Route::put('/drink/{id}', [\App\Http\Controllers\DrinkController::class, 'update']);
Route::delete('/drnk/{id}', [\App\Http\Controllers\DrinkController::class, 'destroy']);


//STATUS

Route::get('/status', [\App\Http\Controllers\StatusController::class, 'index']);
Route::get('/statuses/{user_id}/{event_id}', [\App\Http\Controllers\StatusController::class, 'getById']);
Route::get('/statuses/user/{user_id}', [\App\Http\Controllers\StatusController::class, 'getAllByUserId']);
Route::get('/statuses/event/{event_id}', [\App\Http\Controllers\StatusController::class, 'getAllByEventId']);

Route::post('/statuses', [\App\Http\Controllers\StatusController::class, 'store']);
Route::put('/statuses/{id}', [\App\Http\Controllers\StatusController::class, 'update']);
Route::delete('/statuses/{id}', [\App\Http\Controllers\StatusController::class, 'destroy']);


//TABLE

Route::get('/table', [\App\Http\Controllers\TableController::class, 'index']);
Route::get('/table/{id}', [\App\Http\Controllers\TableController::class, 'getById']);
Route::post('/table', [\App\Http\Controllers\TableController::class, 'store']);
Route::put('/table/{id}', [\App\Http\Controllers\TableController::class, 'update']);
Route::delete('/table/{id}', [\App\Http\Controllers\TableController::class, 'destroy']);

//ORDER

Route::get('/order', [\App\Http\Controllers\OrderController::class, 'index']);
Route::get('/order/event/{id}', [\App\Http\Controllers\OrderController::class, 'getByEventId']);
Route::get('/order/{id}', [\App\Http\Controllers\OrderController::class, 'getById']); //id tabele
Route::post('/order', [\App\Http\Controllers\OrderController::class, 'store']);
Route::put('/order/{id}', [\App\Http\Controllers\OrderController::class, 'update']);
Route::delete('/order/{id}', [\App\Http\Controllers\OrderController::class, 'destroy']);

Route::get('/unauthorized', [UnauthorizedController::class, 'unauthorized'])->name('unauthorized');
