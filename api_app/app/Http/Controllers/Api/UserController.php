<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserCollection::make(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validar datos
        $request->validate([
            'data.attributes.name' => ['required', 'min:4'],
            'data.attributes.email' => ['required', 'email'],
            'data.attributes.password'=>['required'],
            
            
        ]);

        // Almacenar datos
        $user = User::create([
            'name' => $request->input('data.attributes.name'),
            'email' => $request->input('data.attributes.email'),
            'password' => $request->input('data.attributes.password'),
        ]);

        return UserResource::make($user);

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource ($user); // no tiene que haber codigo, aqui tenemos el recurso.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)  
    {
    // Validar datos
    $request->validate([
        'name' => $request->input('data.attributes.name'),
        'email' => $request->input('data.attributes.email'),
        'password' => $request->input('data.attributes.password'),
    ]);

    // Actualizar datos del video
    $user->update([
        'name' => $request->input('data.attributes.name'),
        'email' => $request->input('data.attributes.email'),
        'password' => $request->input('data.attributes.password'),
    ]);

    return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        //Por normas es adecuado mandar un 204 ya que es No Content o no existe el contenido.
        return response()->json(null, 204);
    }
}
