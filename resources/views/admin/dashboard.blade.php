<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="card stat-card">
                    <div class="stat-number">{{ $totalStudents }}</div>
                    <div class="stat-label">Total Students</div>
                </div>
                <div class="card stat-card">
                    <div class="stat-number">{{ $totalCourses }}</div>
                    <div class="stat-label">Total Courses</div>
                </div>
                <div class="card stat-card">
                    <div class="stat-number">{{ $totalEnrollments }}</div>
                    <div class="stat-label">Total Enrollments</div>
                </div>
            </div>

            <div class="card">
                <h3 class="card-title">Quick Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
                        Add Course
                    </a>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                        Add User
                    </a>
                    <a href="{{ route('admin.courses') }}" class="btn btn-primary">
                        Manage Courses
                    </a>
                    <a href="{{ route('admin.grades') }}" class="btn btn-primary">
                        Manage Grades
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>