<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AuthController
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'data.attributes.name' => ['required', 'string', 'min:4'],
            'data.attributes.email' => ['required', 'email', 'lowercase', 'unique:users,email'],
            'data.attributes.password' => ['required', 'confirmed'],
            /*'data.attributes.password'=>[
                'required',
                'string',
                'min=8',
                'regex:/[a-z]/',
                'regex:/[A-Z/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ],*/
        ]); 
        $user = User::create([
            'name' => $request->input('data.attributes.name'),
            'email' => $request->input('data.attributes.email'),
            'password' => $request->input(('data.attributes.password')),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }



    public function login(Request $request){
        $credentials = $request->validate([
            'data.attributes.email' => ['required', 'email'],
            'data.attributes.password' => ['required'],
        ]);

        $credentials = [
            'email' => $request->input('data.attributes.email'),
            'password' => $request->input('data.attributes.password'),
        ];
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            $cookie = cookie('cookie_token', $token, 60*24);
            return response(["token" => $token], response::HTTP_OK)->withCookie($cookie);
        } else{
            return response(["message" => "Credenciales inválidas"], Response::HTTP_INAUTHORIZED);
        }
    }
}
