<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Take;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student = Auth::user()->student;
        $enrolledCourses = $student->courses()->count();
        $totalCredits = $student->courses()->sum('credits');
        $averageGrade = Take::where('student_id', $student->student_id)
                          ->whereNotNull('grade')
                          ->avg('grade');
        
        return view('student.dashboard', compact('enrolledCourses', 'totalCredits', 'averageGrade'));
    }

    public function courses()
    {
        $availableCourses = Course::whereNotIn('course_id', function($query) {
            $query->select('course_id')
                  ->from('takes')
                  ->where('student_id', Auth::user()->student->student_id);
        })->get();

        $enrolledCourses = Auth::user()->student->courses()->get();

        return view('student.courses', compact('availableCourses', 'enrolledCourses'));
    }

    public function enroll(Request $request, $courseId)
    {
        $student = Auth::user()->student;
        
        Take::create([
            'student_id' => $student->student_id,
            'course_id' => $courseId,
            'enroll_date' => now()
        ]);

        return redirect()->back()->with('success', 'Successfully enrolled in course');
    }

    public function grades()
    {
        $student = Auth::user()->student;
        $grades = Take::with('course')
                     ->where('student_id', $student->student_id)
                     ->get();

        return view('student.grades', compact('grades'));
    }
}
