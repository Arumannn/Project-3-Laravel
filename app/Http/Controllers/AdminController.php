<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Take;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalStudents = User::where('role', 'student')->count();
        $totalCourses = Course::count();
        $totalEnrollments = Take::count();
        
        return view('admin.dashboard', compact('totalStudents', 'totalCourses', 'totalEnrollments'));
    }

    public function courses()
    {
        $courses = Course::withCount('students')->get();
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
            'credits' => 'required|integer|min:1'
        ]);

        Course::create($request->all());
        return redirect()->route('admin.courses')->with('success', 'Course created successfully');
    }

    public function users()
    {
        $users = User::with('student')->get();
        return view('admin.users', compact('users'));
    }

    public function createUser()
    {
        return view('admin.create-user');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,student',
            'full_name' => 'required|string|max:255',
            'entry_year' => 'required_if:role,student|integer'
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'full_name' => $request->full_name
        ]);

        if ($request->role === 'student') {
            Student::create([
                'user_id' => $user->user_id,
                'entry_year' => $request->entry_year
            ]);
        }

        return redirect()->route('admin.users')->with('success', 'User created successfully');
    }

    public function grades()
    {
        $takes = Take::with(['student.user', 'course'])->get();
        return view('admin.grades', compact('takes'));
    }

    public function assignGrade(Request $request, $takeId)
    {
        $request->validate([
            'grade' => 'required|numeric|min:0|max:100'
        ]);

        $take = Take::findOrFail($takeId);
        $take->update(['grade' => $request->grade]);

        return redirect()->back()->with('success', 'Grade assigned successfully');
    }
}