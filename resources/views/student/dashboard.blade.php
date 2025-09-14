<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Enrolled Courses</h3>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $enrolledCourses }}</p>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Total Credits</h3>
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $totalCredits }}</p>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Average Grade</h3>
                        <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">
                            {{ $averageGrade ? number_format($averageGrade, 2) : 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('student.courses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded text-center">
                            Browse & Enroll Courses
                        </a>
                        <a href="{{ route('student.grades') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded text-center">
                            View My Grades
                        </a>
                        <a href="{{ route('profile.edit') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded text-center">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
