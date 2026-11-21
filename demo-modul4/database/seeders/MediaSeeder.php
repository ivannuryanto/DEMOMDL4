<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $media = [
            [
                'title' => 'Frieren: Beyond Journey’s End',
                'description' => 'Perjalanan elf penyihir memahami arti hubungan setelah petualangan berakhir.',
                'genre' => 'Adventure, Drama',
                'episodes' => 28,
                'release_year' => 2023,
                'type' => 'Anime',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'One Piece',
                'description' => 'Petualangan kru Topi Jerami dalam mencari harta karun legendaris.',
                'genre' => 'Action, Adventure',
                'episodes' => 1122,
                'release_year' => 1999,
                'type' => 'Anime',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Haikyuu!!',
                'description' => 'Perjuangan tim voli SMA untuk mencapai pertandingan nasional.',
                'genre' => 'Sports, Comedy',
                'episodes' => 85,
                'release_year' => 2014,
                'type' => 'Anime',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($media as $item) {
            Media::query()->updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
