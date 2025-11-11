<?php

namespace Database\Seeders;

use App\Models\Musical;
use App\Models\Actor;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MusicalSeeder extends Seeder
{
    public function run(): void
    {
        $currentTimestamp = Carbon::now();

        $musicals = [
            [
                'title' => 'Hamilton',
                'image' => 'Hamilton.jpg',
                'description' => 'A hip-hop musical about the life of Alexander Hamilton.',
                'duration' => 160,
                'director' => 'Thomas Kail',
                'premiere_date' => '2015-01-20',
                'video' => 'https://www.youtube.com/watch?v=DSCKfXpAGHc',
            ],
            [
                'title' => 'The Phantom of the Opera',
                'image' => 'The_Phantom_of_the_Opera.jpg',
                'description' => 'A classic Andrew Lloyd Webber musical set in a Paris opera house.',
                'duration' => 145,
                'director' => 'Harold Prince',
                'premiere_date' => '1986-10-09',
                'video' => 'https://www.youtube.com/watch?v=oJOIhEdakkA',
            ],
            [
                'title' => 'Wicked',
                'image' => 'Wicked.jpg',
                'description' => 'The untold story of the witches of Oz.',
                'duration' => 150,
                'director' => 'Joe Mantello',
                'premiere_date' => '2003-10-30',
                'video' => 'https://www.youtube.com/watch?v=6COmYeLsz4c',
            ],
        ];

        foreach ($musicals as $musicalData) {
            $musical = Musical::create(array_merge(
                $musicalData,
                ['created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp]
            ));

            // Make sure you have ActorSeeder run first (see fix below)
            $actors = Actor::inRandomOrder()->take(2)->pluck('id');
            $musical->actors()->attach($actors);
        }
    }
}
