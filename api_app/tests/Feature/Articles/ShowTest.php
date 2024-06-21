<?php

namespace Tests\Feature\Articles;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_fetch_a_single_article(): void
    {
        $this->withoutExceptionHandling();
        $video = Video::factory()->create();
        $response = $this->getJson(route('api.videos.show',$video));
        $response->assertExactJson([
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
}
