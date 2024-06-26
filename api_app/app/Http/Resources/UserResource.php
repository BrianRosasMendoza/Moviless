<?php
 
namespace App\Http\Resources;
 
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
 
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'users',
            'id' => (string)$this->resource->getRouteKey(),
            'attributes' => [ //Propiedad
                'name' => $this->resource->name, //Atributos (name email created at updated at)
                'email' => $this->resource->email, 
                'created_at' => $this->resource->created_at,
                'updated_at' => $this->resource->updated_at,
            ],
            'links' => [ //Propiedad
                'self' => route('api.users.show', $this->resource) //Atributo
            ]
        ];
    }
}
