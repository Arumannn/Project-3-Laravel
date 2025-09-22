<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Take;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    // === METHOD YANG DIPERBAIKI ===
    public function dashboard()
    {
        // Menghitung total user berdasarkan role
        $totalStudent = User::where('role', 'student')->count();
        $totalAdmin = User::where('role', 'admin')->count();
        
        // Menghitung total mata kuliah
        $totalCourses = Course::count();

        // Mengirimkan semua data statistik ke view
        return view('admin.dashboard', compact('totalStudent', 'totalAdmin', 'totalCourses'));
    }

    public function courses()
    {
        // Anda mungkin perlu menambahkan logika untuk menampilkan daftar course di sini
        $courses = Course::all();
        return view('admin.courses', compact('courses'));
    }

    public function createCourse()
    {
        return view('admin.create-course');
    }

    public function storeCourse(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1',
        ]);
    
        Course::create([
            'course_name' => $request->course_name,
            'credits' => $request->credits,
        ]);
    
        return redirect()->route('admin.courses')->with('success', 'Course created successfully.');
    }

    public function users()
    {
        $students = User::where('role', 'student')->with('student')->get();
        $admins = User::where('role', 'admin')->get();
        return view('admin.users', compact('students', 'admins'));
    }

    public function createUser()
    {
        return view('admin.create-user');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,student'],
            'nim' => ['required_if:role,student', 'nullable', 'string', 'unique:students,nim'],
            'entry_year' => ['required_if:role,student', 'nullable', 'digits:4', 'integer', 'min:1900'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($request->role === 'student') {
            Student::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'entry_year' => $request->entry_year,
            ]);
        }

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function grades()
    {
        $takes = Take::with(['student.user', 'course'])->get();
        return view('admin.grades', compact('takes'));
    }

    public function assignGrade(Request $request, Take $take)
    {
        $request->validate([
            'grade' => 'required|numeric|min:0|max:100',
        ]);

        $take->update(['grade' => $request->grade]);

        return redirect()->back()->with('success', 'Grade assigned successfully.');
    }
}