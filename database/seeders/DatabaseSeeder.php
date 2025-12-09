<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Report;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Categories
        $categories = [
            ['name' => 'Infrastructure', 'slug' => 'infrastructure'],
            ['name' => 'Social', 'slug' => 'social'],
            ['name' => 'Safety', 'slug' => 'safety'],
            ['name' => 'Environment', 'slug' => 'environment'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // 2. Create Users (Admin & Citizen)
        $admin = User::create([
            'name' => 'Admin Officer',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $citizen = User::create([
            'name' => 'John Citizen',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'citizen',
        ]);

        // 3. Create Dummy Reports
        $cats = Category::all();

        Report::create([
            'user_id' => $citizen->id,
            'category_id' => $cats->where('slug', 'infrastructure')->first()->id,
            'title' => 'Pothole on Main Street',
            'description' => 'There is a large pothole causing traffic issues near the central station.',
            'location' => 'Main St. Junction',
            'status' => 'pending',
        ]);

        Report::create([
            'user_id' => $citizen->id,
            'category_id' => $cats->where('slug', 'safety')->first()->id,
            'title' => 'Broken Street Light',
            'description' => 'Street light #404 is flickering and finally went out last night. It is very dark here.',
            'location' => 'Elm Street',
            'status' => 'resolved',
        ]);
        
        Report::create([
            'user_id' => $citizen->id,
            'category_id' => $cats->where('slug', 'environment')->first()->id,
            'title' => 'Trash Pileup',
            'description' => 'Garbage has not been collected for 2 weeks at the park entrance.',
            'location' => 'City Park Gate 1',
            'status' => 'process',
        ]);
    }
}
