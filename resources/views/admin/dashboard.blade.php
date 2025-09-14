<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Total Students</h3>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $totalStudents }}</p>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Total Courses</h3>
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $totalCourses }}</p>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Total Enrollments</h3>
                        <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $totalEnrollments }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('admin.courses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                            Add Course
                        </a>
                        <a href="{{ route('admin.users.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-center">
                            Add User
                        </a>
                        <a href="{{ route('admin.courses') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded text-center">
                            Manage Courses
                        </a>
                        <a href="{{ route('admin.grades') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-center">
                            Manage Grades
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
