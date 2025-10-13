<?php

namespace Database\Seeders;

use App\Models\Musical;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MusicalSeeder extends Seeder{
    public function run(): void{
        Musical::insert([ //inserts experiment data into the database to check if things are working.
            [
                'title' => 'Hamilton',
                'image' => 'Hamilton.jpg',
                'description' => 'A hip-hop musical about the life of Alexander Hamilton.',
                'duration' => 160,
                'director' => 'Thomas Kail',
                'premiere_date' => '2015-01-20',
            ],
            [
                'title' => 'The Phantom of the Opera',
                'image' => 'The_Phantom_of_the_Opera.jpg',
                'description' => 'A classic Andrew Lloyd Webber musical set in a Paris opera house.',
                'duration' => 145,
                'director' => 'Harold Prince',
                'premiere_date' => '1986-10-09',
            ],
            [
                'title' => 'Wicked',
                'image' => 'Wicked.jpg',
                'description' => 'The untold story of the witches of Oz.',
                'duration' => 150,
                'director' => 'Joe Mantello',
                'premiere_date' => '2003-10-30',
            ],
        ]);
    }
}
