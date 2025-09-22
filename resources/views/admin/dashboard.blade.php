<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-blue-100 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold">Total Students</h4>
                            <p class="text-3xl font-bold mt-2">{{ $totalStudents }}</p>
                        </div>
                        <div class="bg-green-100 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold">Total Courses</h4>
                            <p class="text-3xl font-bold mt-2">{{ $totalCourses }}</p>
                        </div>
                        <div class="bg-yellow-100 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold">Total Enrollments</h4>
                            <p class="text-3xl font-bold mt-2">{{ $totalEnrollments }}</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-lg font-semibold">Recent Enrollments</h4>
                        <ul class="mt-4">
                            @forelse($recentEnrollments as $enrollment)
                                <li class="border-b py-2">
                                    <span class="font-semibold">{{ $enrollment->student->user->full_name }}</span> enrolled in <span class="font-semibold">{{ $enrollment->course->course_name }}</span>.
                                    <span class="text-sm text-gray-500 float-right">{{ $enrollment->created_at->diffForHumans() }}</span>
                                </li>
                            @empty
                                <li class="py-2">No recent enrollments.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>