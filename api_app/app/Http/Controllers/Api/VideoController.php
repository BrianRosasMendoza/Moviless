<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\VideoCollection;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return VideoCollection::make(Video::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validar datos
        $request->validate([
            'data.attributes.title' => ['required', 'min:4'],
            'data.attributes.description' => ['required'],
            'data.attributes.slug'=>['required'],
            'data.attributes.user_id'=>['required'],
            'data.attributes.category_id'=>['required'],
            
        ]);

        // Almacenar datos
        $video = Video::create([
            'title' => $request->input('data.attributes.title'),
            'description' => $request->input('data.attributes.description'),
            'slug' => $request->input('data.attributes.slug'),
            'user_id' => $request->input('data.attributes.user_id'),
            'category_id' => $request->input('data.attributes.category_id'),
        ]);

        return VideoResource::make($video);

        //
    }

    public function show(Video $video)
    {
        return response()->json([
            'data' > [
                'type' => 'videos',
                'id' => (string)$video->getRouteKey(),
                'attributes' => [ //Propiedad
                    'title' => $video->title, //Atributos (name email created at updated at)
                    'description' => $video->description, 
                    'slug' => $video->slug, 
                    'user_id' => $video->user_id, 
                    'category_id' => $video->category_id, 
                ],
                'links' => [ //Propiedad
                    'self' => route('api.videos.show', $video) //Atributo
                ]
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)  
    {
    // Validar datos
    $request->validate([
        'data.attributes.title' => ['required', 'min:4'],
        'data.attributes.description' => ['required'],
        'data.attributes.slug'=>['required'],
        'data.attributes.user_id'=>['required'],
        'data.attributes.category_id'=>['required'],
    ]);

    // Actualizar datos del video
    $video->update([
        'title' => $request->input('data.attributes.title'),
        'description' => $request->input('data.attributes.description'),
        'slug' => $request->input('data.attributes.slug'),
        'user_id' => $request->input('data.attributes.user_id'),
        'category_id' => $request->input('data.attributes.category_id'),
    ]);

    return new VideoResource($video);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $video->delete();

        //Por normas es adecuado mandar un 204 ya que es No Content o no existe el contenido.
        return response()->json(null, 204);
    }
}
