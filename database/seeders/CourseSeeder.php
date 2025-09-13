<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder {
    public function run(): void {
        Course::create(['course_name' => 'Basis Data', 'credits' => 3]);
        Course::create(['course_name' => 'Algoritma', 'credits' => 4]);
        Course::create(['course_name' => 'Pemrograman Web', 'credits' => 3]);
    }
}
