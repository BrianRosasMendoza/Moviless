<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'videos',
            'id' => (string)$this->resource->getRouteKey(),
            'attributes' => [ //Propiedad
                'title' => $this->resource->title, //Atributos (name email created at updated at)
                'description' => $this->resource->description, 
                'slug' => $this->resource->slug, 
                'user_id' => $this->resource->user_id, 
                'category_id' => $this->resource->category_id, 
                'created_at' => $this->resource->created_at,
                'updated_at' => $this->resource->updated_at,
            ],
            'links' => [ //Propiedad
                'self' => route('api.videos.show', $this->resource) //Atributo
            ]
            
        ];
    }
}
