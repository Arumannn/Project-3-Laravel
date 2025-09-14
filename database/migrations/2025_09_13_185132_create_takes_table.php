
Arumannn/Project-3-Laravel
main

GITHUB

Create an academic website with two roles: Admin and Student.
* The Admin role should have full control, including:
   1. Adding courses
   2. Adding user accounts
   3. Assigning grades to students
* The Student role should only be able to:
   1. View their own grades
   2. Enroll in courses that the Admin has added
Additionally:
* There should be no registration page; only Admins can create accounts.
* The login page should appear directly in the center of the welcome.blade.php view."

Looking at your Laravel application structure, I'll help you create an academic website with Admin and Student roles. I can see you already have authentication set up and some models for courses and students. Let me create the complete system for you.

Academic Website Implementation
Code 
Now let me create the database migrations and update existing ones:

Database Migrations
Code 
Now let me create the blade templates for the admin and student interfaces:

Admin Views
Code 
Continue

Admin Views
Code ∙ Version 2 
Now let me create the student views:

Student Views
Code 
Now let me update the welcome page with the login form and create the necessary routes:

Updated Welcome Page and Routes
Code 
Now let me update the navigation to be role-specific:

Updated Navigation and Layouts
Code 
Continue

Updated Navigation and Layouts
Code ∙ Version 2 
Now let me create the final configuration file to register the middleware:

Configuration Updates and Installation Instructions
Code 
Perfect! I've created a complete academic website with Admin and Student roles. Here's a summary of what I've built for you:

🎓 Academic Website Features
Admin Role Capabilities:
Dashboard: Overview with statistics (total students, courses, enrollments)
Course Management: Add new courses, view enrolled students
User Management: Create admin and student accounts (no public registration)
Grade Management: Assign grades to students for their enrolled courses
Student Role Capabilities:
Dashboard: Personal statistics (enrolled courses, total credits, average grade)
Course Enrollment: Browse available courses and enroll
Grade Viewing: View personal grades and academic summary
Security Features:
✅ No Registration Page: Only admins can create accounts
✅ Role-based Access Control: Middleware protects admin/student routes
✅ Centralized Login: Login form directly on welcome page
🚀 Installation Steps:
Create the middleware file:
bash
php artisan make:middleware CheckRole
Run the migration to update tables:
bash
php artisan make:migration update_takes_table_add_grade
php artisan migrate:fresh --seed
Clear caches:
bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
🔐 Demo Accounts:
Admin: admin@academic.com / password123
Student: arman.yusuf.tif24@polban.ac.id / password123
📁 File Structure:
The implementation includes:

Updated Models (User, Course, Student, Take, Grade)
Controllers (AdminController, StudentController)
Middleware (CheckRole)
Views (Admin and Student dashboards, forms, tables)
Updated navigation and authentication
Database migrations and seeders
The system provides a complete academic management solution where administrators have full control over courses, users, and grades, while students can only view their own information and enroll in courses. The interface is clean, responsive, and role-specific!






<?php

// Update the takes table migration
// File: database/migrations/2025_09_13_185132_create_takes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('takes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->date('enroll_date');
            $table->decimal('grade', 5, 2)->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
            $table->unique(['student_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('takes');
    }
};