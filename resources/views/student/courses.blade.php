<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('My Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Available Courses Section -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-4">Available Courses</h3>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        @if($availableCourses->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($availableCourses as $course)
                                <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-4">
                                    <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $course->course_name }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ $course->credits }} Credits</p>
                                    <form method="POST" action="{{ route('student.enroll', $course->course_id) }}">
                                        @csrf
                                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Enroll
                                        </button>
                                    </form>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-600 dark:text-gray-400">No available courses to enroll in.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Enrolled Courses Section -->
            <div>
                <h3 class="text-xl font-semibold mb-4">My Enrolled Courses</h3>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        @if($enrolledCourses->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full table-auto">
                                    <thead>
                                        <tr class="bg-gray-100 ">
                                            <th class="px-4 py-2 text-left">Course Name</th>
                                            <th class="px-4 py-2 text-left">Credits</th>
                                            <th class="px-4 py-2 text-left">Enrolled Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($enrolledCourses as $course)
                                        <tr class="border-b dark:border-gray-600">
                                            <td class="px-4 py-2">{{ $course->course_name }}</td>
                                            <td class="px-4 py-2">{{ $course->credits }}</td>
                                            <td class="px-4 py-2">{{ $course->pivot->enroll_date }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-600 dark:text-gray-400">You are not enrolled in any courses yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>