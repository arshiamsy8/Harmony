<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            'Pop',
            'Rock',
            'Hip Hop',
            'R&B',
            'Electronic',
            'Jazz',
            'Classical',
            'Country',
            'Blues',
            'Folk',
            'Metal',
            'Punk',
            'Reggae',
            'Soul',
            'Funk',
            'Gospel',
            'Indie',
            'Alternative',
            'Dance',
            'Latin'
        ];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
} 