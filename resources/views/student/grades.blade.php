<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('My Grades') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($grades->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-100 ">
                                        <th class="px-4 py-2 text-left">Course Name</th>
                                        <th class="px-4 py-2 text-left">Credits</th>
                                        <th class="px-4 py-2 text-left">Grade</th>
                                        <th class="px-4 py-2 text-left">Status</th>
                                        <th class="px-4 py-2 text-left">Enroll Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($grades as $grade)
                                    <tr class="border-b ">
                                        <td class="px-4 py-2">{{ $grade->course->course_name }}</td>
                                        <td class="px-4 py-2">{{ $grade->course->credits }}</td>
                                        <td class="px-4 py-2">
                                            @if($grade->grade)
                                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                                    {{ $grade->grade >= 75 ? 'bg-green-100 text-green-800' : ($grade->grade >= 60 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                    {{ number_format($grade->grade, 2) }}
                                                </span>
                                            @else
                                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    Not Graded
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">
                                            @if(is_null($grade->grade))
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    In Progress
                                                </span>
                                            @elseif($grade->grade >= 2.75)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Passed
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Failed
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">{{ $grade->enroll_date }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- GPA Calculation -->
                        <div class="mt-6 p-4 bg-gray-100 rounded-lg">
                            <h4 class="font-semibold  mb-2">Academic Summary</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Courses</p>
                                    <p class="text-lg font-semibold ">{{ $grades->count() }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Graded Courses</p>
                                    <p class="text-lg font-semibold ">{{ $grades->whereNotNull('grade')->count() }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Average Grade</p>
                                    <p class="text-lg font-semibold ">
                                        {{ $grades->whereNotNull('grade')->avg('grade') ? number_format($grades->whereNotNull('grade')->avg('grade'), 2) : 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-600 dark:text-gray-400 mb-4">You haven't enrolled in any courses yet.</p>
                            <a href="{{ route('student.courses') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Browse Courses
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>