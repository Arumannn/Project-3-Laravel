<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome, Admin!") }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700">Total Students</h3>
                        <p class="mt-2 text-3xl font-bold text-blue-500">{{ $totalStudent }}</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700">Total Admins</h3>
                        <p class="mt-2 text-3xl font-bold text-green-500">{{ $totalAdmin }}</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700">Total Courses</h3>
                        <p class="mt-2 text-3xl font-bold text-purple-500">{{ $totalCourses }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>