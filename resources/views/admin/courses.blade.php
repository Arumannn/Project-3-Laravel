<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Manage Courses') }}
            </h2>
            <a href="{{ route('admin.courses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Course
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="px-4 py-2 text-left">Course ID</th>
                                    <th class="px-4 py-2 text-left">Course Name</th>
                                    <th class="px-4 py-2 text-left">Credits</th>
                                    <th class="px-4 py-2 text-left">Enrolled Students</th>
                                    <th class="px-4 py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                <tr class="border-b dark:border-gray-600">
                                    <td class="px-4 py-2">{{ $course->course_id }}</td>
                                    <td class="px-4 py-2">{{ $course->course_name }}</td>
                                    <td class="px-4 py-2">{{ $course->credits }}</td>
                                    <td class="px-4 py-2">{{ $course->students_count }}</td>
                                    <td class="px-4 py-2">
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
