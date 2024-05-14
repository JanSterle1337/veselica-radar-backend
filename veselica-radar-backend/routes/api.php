<?php

use App\Http\Controllers\UnauthorizedController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/sanctum/token', function (Request $request) {
   $request->validate([
       'email' => 'required|string|email',
       'password' => 'required|string',
       'device_name' => 'required|string'
   ]);

   $user = \App\Models\User::where('email', $request->input('email'))->first();

   if (! $user || ! Hash::check($request->input('password'), $user->password)) {
       throw \Illuminate\Validation\ValidationException::withMessages([
           'email' => ['The provided credentials are incorrect.'],
       ]);
   }

   return $user->createToken($request->input('device_name'))->plainTextToken;
});

Route::middleware('auth:sanctum')->group(function() {
   Route::get('/events', [EventsController::class, 'index']);
});

//Route::get('/events', [EventsController::class, 'index']);
Route::get('/events/{id}', [EventsController::class, 'getById']);
Route::post('/events', [EventsController::class, 'store']);
Route::put('/events/{id}', [EventsController::class, 'update']);
Route::delete('/events/{id}', [EventsController::class, 'destroy']);


Route::get('/unauthorized', [UnauthorizedController::class, 'unauthorized'])->name('unauthorized');
