<x-app-layout>
    <x-slot name="header">
        {{-- "dark:text-gray-200" removed --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Replaced the old div with the consistent "card" component style --}}
            <div class="card">
                <form method="POST" action="{{ route('admin.courses.store') }}">
                    @csrf
                    
                    <div class="mb-4">
                        {{-- "dark:text-gray-300" removed --}}
                        <label for="course_name" class="block text-sm font-medium text-gray-700">Course Name</label>
                        {{-- Removed all "dark:" classes from the input --}}
                        <input type="text" id="course_name" name="course_name" required
                               class="mt-1 block w-full">
                        @error('course_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        {{-- "dark:text-gray-300" removed --}}
                        <label for="credits" class="block text-sm font-medium text-gray-700">Credits</label>
                        {{-- Removed all "dark:" classes from the input --}}
                        <input type="number" id="credits" name="credits" min="1" required
                               class="mt-1 block w-full">
                        @error('credits')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end pt-4 mt-4 border-t">
                        {{-- NOTE: I've added a "btn-secondary" class for cancel buttons. You'll need to add its style to app.css --}}
                        <a href="{{ route('admin.courses') }}" class="btn btn-secondary mr-2">
                            Cancel
                        </a>
                        {{-- Replaced hardcoded styles with our "btn btn-primary" class --}}
                        <button type="submit" class="btn btn-primary">
                            Create Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>