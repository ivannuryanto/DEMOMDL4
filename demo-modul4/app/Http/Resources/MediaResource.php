<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'genre' => $this->genre,
            'episodes' => $this->episodes,
            'release_year' => $this->release_year,
            'type' => $this->type,
            'collected_by' => $this->relationLoaded('collectedBy')
                ? $this->collectedBy
                    ->map(fn ($user) => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                    ])
                    ->values()
                : [],
        ];
    }
}
