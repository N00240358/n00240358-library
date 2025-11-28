<?php

namespace Database\Seeders;

use App\Models\Song;
use App\Models\Musical;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SongSeeder extends Seeder
{ //seed songs table
    public function run(): void
    {
        $currentTimestamp = Carbon::now();

        // Songs grouped by musical title
        $songs = [
            'Hamilton' => [
                [
                    'title' => 'Alexander Hamilton',
                    'duration' => 3.35,
                    'composer' => 'Lin-Manuel Miranda',
                ],
                [
                    'title' => 'My Shot',
                    'duration' => 5.32,
                    'composer' => 'Lin-Manuel Miranda',
                ],
                [
                    'title' => 'The Room Where It Happens',
                    'duration' => 5.22,
                    'composer' => 'Lin-Manuel Miranda',
                ],
            ],

            'The Phantom of the Opera' => [
                [
                    'title' => 'The Phantom of the Opera',
                    'duration' => 4.48,
                    'composer' => 'Andrew Lloyd Webber',
                ],
                [
                    'title' => 'Music of the Night',
                    'duration' => 5.15,
                    'composer' => 'Andrew Lloyd Webber',
                ],
                [
                    'title' => 'Masquerade',
                    'duration' => 5.51,
                    'composer' => 'Andrew Lloyd Webber',
                ],
            ],

            'Wicked' => [
                [
                    'title' => 'Defying Gravity',
                    'duration' => 4.50,
                    'composer' => 'Stephen Schwartz',
                ],
                [
                    'title' => 'Popular',
                    'duration' => 3.43,
                    'composer' => 'Stephen Schwartz',
                ],
                [
                    'title' => 'For Good',
                    'duration' => 5.10,
                    'composer' => 'Stephen Schwartz',
                ],
            ],
        ];

        // Loop through musicals and add songs
        foreach ($songs as $musicalTitle => $songList) {
            // Find the musical by title
            $musical = Musical::where('title', $musicalTitle)->first();

            if (!$musical) {
                continue; // in case MusicalSeeder didn't run yet
            }
            // Create songs for the musical
            foreach ($songList as $songData) {
                Song::create([
                    'musical_id' => $musical->id,
                    'title' => $songData['title'],
                    'duration' => $songData['duration'],
                    'composer' => $songData['composer'],
                    'created_at' => $currentTimestamp,
                    'updated_at' => $currentTimestamp,
                ]);
            }
        }
    }
}
