<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call([
            UserSeeder::class,
            CourseSeeder::class,
        ]);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Arman Yusuf Rifandi',
        //     'email' => 'arman.yusuf.tif24@polban.ac.id',
        //     'password' => Hash::make('password123'),
        //     'email_verified_at' => now(),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}
