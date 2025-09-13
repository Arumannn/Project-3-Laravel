<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('users')->insert([
            'username' => 'arman',
            'email' => 'arman.yusuf.tif24@polban.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'student',
            'full_name' => 'Arman Yusuf Rifandi',
        ]);
    }
}
