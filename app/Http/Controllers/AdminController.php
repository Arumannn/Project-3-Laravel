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
        $recentEnrollments = Take::with('student.user', 'course')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalStudents', 'totalCourses', 'totalEnrollments', 'recentEnrollments'));
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
    
    public function editCourse(Course $course)
    {
        return view('admin.edit-course', compact('course'));
    }

    public function updateCourse(Request $request, Course $course)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1',
        ]);

        $course->update($request->all());

        return redirect()->route('admin.courses')->with('success', 'Course updated successfully.');
    }

    public function destroyCourse(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses')->with('success', 'Course deleted successfully.');
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
                'user_id'    => $user->user_id,   
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

    public function editUser(User $user)
    {
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->user_id . ',user_id',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
        ]);

        $user->update($request->all());

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function destroyUser(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }



    public function grades()
    {
        $takes = Take::with(['student.user', 'course'])->get();
        return view('admin.grades', compact('takes'));
    }

        public function assignGrade(Request $request, $takeId)
    {
        // Validasi input
        $validated = $request->validate([
            'grade' => ['required', 'numeric', 'between:0,4'],
        ]);

        // Ambil data take berdasarkan ID
        $take = Take::findOrFail($takeId);

        // Update grade
        $take->grade = $validated['grade'];
        $take->save();

        // Redirect dengan pesan sukses
        return redirect()
            ->back()
            ->with('success', 'Grade assigned successfully.');
    }
}