<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $currentTimestamp = Carbon::now();

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'created_at' => $currentTimestamp,
            'updated_at' => $currentTimestamp,
        ]);

        User::create([
            'name' => 'User User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'created_at' => $currentTimestamp,
            'updated_at' => $currentTimestamp,
        ]);
    }
}
