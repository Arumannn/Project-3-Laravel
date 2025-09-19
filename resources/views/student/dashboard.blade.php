<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Student Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    Welcome back, **{{ Auth::user()->full_name }}**!
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="card stat-card">
                    <div class="stat-number">{{ $enrolledCoursesCount }}</div>
                    <div class="stat-label">Courses Enrolled</div>
                </div>
                <div class="card stat-card">
                    <div class="stat-number">{{ $totalCredits }}</div>
                    <div class="stat-label">Total Credits</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="card">
                        <h3 class="card-title">My Courses</h3>
                        <div class="card-content">
                            <ul>
                                @forelse ($enrolledCourses as $course)
                                    <li class="flex justify-between py-2 border-b last:border-b-0">
                                        <span>{{ $course->course_name }}</span>
                                        <span class="text-sm text-gray-500">{{ $course->credits }} credits</span>
                                    </li>
                                @empty
                                    <li>You are not enrolled in any courses.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <h3 class="card-title">Recent Grades</h3>
                         <div class="card-content">
                            <ul>
                                @forelse ($recentGrades as $grade)
                                    <li class="flex justify-between py-2 border-b last:border-b-0">
                                        <span>{{ $grade->course->course_name }}:</span>
                                        <span class="font-bold text-academic-blue-dark">{{ $grade->grade ?? 'Not Graded' }}</span>
                                    </li>
                                @empty
                                    <li>No grades have been assigned yet.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="card">
                        <h3 class="card-title">Announcements</h3>
                        <div class="card-content">
                             <ul>
                                <li>Platform Update: Scheduled</li>
                                <li>Reminder: Study Group Tonight</li>
                            </ul>
                        </div>
                    </div>
                     <div class="card">
                        <h3 class="card-title">Quick Actions</h3>
                        <div class="flex flex-col space-y-3 mt-4">
                             <a href="{{ route('student.courses') }}" class="btn btn-primary w-full">Browse & Enroll</a>
                             <a href="{{ route('student.grades') }}" class="btn btn-primary w-full">View My Grades</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>