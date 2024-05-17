<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register( Request $request){

        #$data = "neki";

        /*$data = $request->validate([
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed'
        ]);*/

        $data = [
            'name' => $request->input('name'),
            'lastName' => $request->input('lastName'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role')
        ];


        //return response()->json(['data' => $data]);

        // Set default role to 'admin' if not provided in the request
        //$userData = array_merge($data);


        // Mass assign the validated request data to a new instance of the User model
        $user = User::create($data);
        $token = $user->createToken('my-token')->plainTextToken;

        return response()->json([
            'token' =>$token,
            'Type' => 'Bearer'
        ], 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Wrong credentials'
            ]);
        }

        $token = $user->createToken('my-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'Type' => 'Bearer',
            'role' => $user->role // include user role in response
        ]);
    }
}
