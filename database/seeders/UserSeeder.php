<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;   
use Illuminate\Support\Facades\Hash; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@academic.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'full_name' => 'System Administrator',
        ]);

        // Create student user (update existing)
        $student = User::create([
            'username' => 'arman',
            'email' => 'arman.yusuf.tif24@polban.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'student',
            'full_name' => 'Arman Yusuf Rifandi',
        ]);

        // Create student record
        Student::create([
            'user_id' => $student->user_id,
            'entry_year' => 2024
        ]);
    }
}
