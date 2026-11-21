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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'collections' => $this->relationLoaded('collections')
                ? $this->collections
                    ->map(fn ($media) => [
                        'id' => $media->id,
                        'title' => $media->title,
                        'genre' => $media->genre,
                        'episodes' => $media->episodes,
                        'release_year' => $media->release_year,
                        'type' => $media->type,
                    ])
                    ->values()
                : [],
        ];
    }
}
