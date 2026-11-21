<?php

namespace Tests\Feature;

use App\Models\Media;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateResourceTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_be_updated_with_put(): void
    {
        $user = User::factory()->create([
            'name' => 'Nama Lama',
            'email' => 'lama@example.com',
        ]);

        $response = $this->putJson("/api/users/{$user->id}", [
            'name' => 'Nama Baru',
            'email' => 'baru@example.com',
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('data.name', 'Nama Baru')
            ->assertJsonPath('data.email', 'baru@example.com');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Nama Baru',
            'email' => 'baru@example.com',
        ]);
    }

    public function test_media_can_be_updated_with_put(): void
    {
        $media = Media::create([
            'title' => 'Judul Lama',
            'description' => 'Deskripsi Lama',
            'genre' => 'Action',
            'episodes' => 12,
            'release_year' => 2024,
            'type' => 'Anime',
        ]);

        $response = $this->putJson("/api/media/{$media->id}", [
            'title' => 'Judul Baru',
            'description' => 'Deskripsi Baru',
            'genre' => 'Drama',
            'episodes' => 24,
            'release_year' => 2025,
            'type' => 'Movie',
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('data.title', 'Judul Baru')
            ->assertJsonPath('data.description', 'Deskripsi Baru')
            ->assertJsonPath('data.genre', 'Drama')
            ->assertJsonPath('data.episodes', 24)
            ->assertJsonPath('data.release_year', 2025);

        $this->assertDatabaseHas('media', [
            'id' => $media->id,
            'title' => 'Judul Baru',
            'description' => 'Deskripsi Baru',
            'genre' => 'Drama',
            'episodes' => 24,
            'release_year' => 2025,
            'type' => 'Movie',
        ]);
    }
}
