<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actor;
use Carbon\Carbon;

class ActorSeeder extends Seeder
{
    public function run(): void //seed actors table
    {
        $currentTimestamp = Carbon::now();

        $actors = [
            [
                'name' => 'John Doe',
                'birthdate' => '1980-05-15',
                'biography' => 'An accomplished actor known for his versatility.',
            ],
            [
                'name' => 'Jane Smith',
                'birthdate' => '1990-08-22',
                'biography' => 'A rising star in the musical theatre world.',
            ],
            [
                'name' => 'Alice Johnson',
                'birthdate' => '1975-12-03',
                'biography' => 'Veteran actress with numerous awards.',
            ],
        ];

        foreach ($actors as $actorData) { //create actors
            Actor::create(array_merge(
                $actorData,
                ['created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp]
            ));
        }
    }
}
