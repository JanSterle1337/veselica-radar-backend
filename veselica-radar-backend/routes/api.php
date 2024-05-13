<?php

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


Route::get('/events', [EventsController::class, 'index']);
Route::get('/events/{id}', [EventsController::class, 'getById']);
