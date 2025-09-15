<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Take;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


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
    $rules = [
    'username'   => 'required|string|unique:users,username|max:255',
    'email'      => 'required|email|unique:users,email',
    'password'   => 'required|min:6',
    'role'       => 'required|in:admin,student',
    'full_name'  => 'required|string|max:255',
];

    if ($request->role === 'student') {
        $rules['entry_year'] = 'required|integer|min:2000|max:' . (date('Y') + 1);
    }

    $request->validate($rules);

    DB::beginTransaction();
    try {
        // Buat user
        $user = User::create([
            'username'  => $request->username,
            'email'     => $request->email,  
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'full_name' => $request->full_name
        ]);

        // Jika role adalah student, buat record student
        if ($request->role === 'student') {
            Student::create([
                'user_id'    => $user->id,   
                'entry_year' => $request->entry_year
            ]);
        }

        DB::commit();
        return redirect()->route('admin.users')->with('success', 'User created successfully');
        
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()
            ->withErrors(['error' => 'Failed to create user: ' . $e->getMessage()])
            ->withInput();
    }
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