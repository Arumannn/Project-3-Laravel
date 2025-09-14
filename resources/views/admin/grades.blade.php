<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Grades') }}
        </h2>
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
                                    <th class="px-4 py-2 text-left">Student Name</th>
                                    <th class="px-4 py-2 text-left">Course</th>
                                    <th class="px-4 py-2 text-left">Enroll Date</th>
                                    <th class="px-4 py-2 text-left">Current Grade</th>
                                    <th class="px-4 py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($takes as $take)
                                <tr class="border-b dark:border-gray-600">
                                    <td class="px-4 py-2">{{ $take->student->user->full_name }}</td>
                                    <td class="px-4 py-2">{{ $take->course->course_name }}</td>
                                    <td class="px-4 py-2">{{ $take->enroll_date }}</td>
                                    <td class="px-4 py-2">
                                        @if($take->grade)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $take->grade >= 75 ? 'bg-green-100 text-green-800' : ($take->grade >= 60 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ $take->grade }}
                                            </span>
                                        @else
                                            <span class="text-gray-500">Not graded</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        <form method="POST" action="{{ route('admin.grades.assign', $take->id) }}" class="inline-flex items-center">
                                            @csrf
                                            <input type="number" name="grade" min="0" max="100" step="0.01" 
                                                   value="{{ $take->grade }}" placeholder="Grade"
                                                   class="w-20 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-sm mr-2">
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                Assign
                                            </button>
                                        </form>
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