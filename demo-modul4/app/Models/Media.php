<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Media extends Model
{
    protected $fillable = [
        'title',
        'description',
        'genre',
        'episodes',
        'release_year',
        'type',
    ];

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'media_id', 'user_id')
            ->withTimestamps();
    }

    public function collectedBy(): BelongsToMany
    {
        return $this->favoritedBy();
    }
}
