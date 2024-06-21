<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\UserResources;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'type'=>'comments',
            'user_id' => (string)$this->resource->getRouteKey(),
            'attributes'=>[
                'body' => $this->body,
                'commentable_id' => $this->commentable_id,
                'commentable_type' => $this->commentable_type,
            ],
            'links' => [
                'self' => route('api.posts.show', $this->resource)
            ],
            'relationships' => [
                'user' => new UserResource($this->whenLoaded('user'),)
            ],
        ];
    }
}
