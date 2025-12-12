<?php

namespace Database\Seeders;

// database/seeders/DatabaseSeeder.php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. TRUNCATE TABLES TO START CLEAN
        DB::table('users')->truncate();
        DB::table('projects')->truncate();

        // 2. INSERT TEST USERS
        DB::table('users')->insert([
            'id' => 1, 
            'name' => 'Sam',
            'email' => 'sam@test.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'id' => 2, 
            'name' => 'Joanna',
            'email' => 'joanna@test.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'id' => 3, 
            'name' => 'Dona', 
            'email' => 'dona@test.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('projects')->insert([
            'pid' => 1, 
            'uid' => 1, 
            'title' => 'New User Onboarding Script', // SAM'S PROJECT
            'start_date' => '2025-12-12',
            'short_description' => 'Draft the initial welcome message and instructions for first-time user registration.',
            'phase' => 'design',
        ]);

        DB::table('projects')->insert([
            'pid' => 2, 
            'uid' => 1, 
            'title' => 'Database Structure Test', // SAM'S PROJECT
            'start_date' => '2025-12-08',
            'short_description' => 'Confirmation that all project data is securely stored and retrieved using the custom pid key.',
            'phase' => 'complete',
        ]);
        
        DB::table('projects')->insert([
            'pid' => 3, 
            'uid' => 2, 
            'title' => 'Final Demo Review', // JOANNA'S PROJECT
            'start_date' => '2025-12-15',
            'short_description' => 'A quick quality assurance run through the completed features.',
            'phase' => 'testing',
        ]);
    }
}