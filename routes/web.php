<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Redirect authenticated users to appropriate dashboard
Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('student.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::middleware(function ($request, $next) {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Access denied. Admin only.');
        }
        return $next($request);
    })->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Course management
        Route::get('/courses', [AdminController::class, 'courses'])->name('courses');
        Route::get('/courses/create', [AdminController::class, 'createCourse'])->name('courses.create');
        Route::post('/courses', [AdminController::class, 'storeCourse'])->name('courses.store');
        
        // User management
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        
        // Grade management
        Route::get('/grades', [AdminController::class, 'grades'])->name('grades');
        Route::post('/grades/{take}', [AdminController::class, 'assignGrade'])->name('grades.assign');
    });
});

// Student Routes
Route::middleware(['auth', 'verified'])->prefix('student')->name('student.')->group(function () {
    Route::middleware(function ($request, $next) {
        if (Auth::user()->role !== 'student') {
            abort(403, 'Access denied. Student only.');
        }
        return $next($request);
    })->group(function () {
        Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
        Route::get('/courses', [StudentController::class, 'courses'])->name('courses');
        Route::post('/courses/{course}/enroll', [StudentController::class, 'enroll'])->name('enroll');
        Route::get('/grades', [StudentController::class, 'grades'])->name('grades');
    });
});

// Profile Routes (available to both admin and student)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
