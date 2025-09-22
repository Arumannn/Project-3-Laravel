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

            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-4">Available Courses</h3>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        @if($availableCourses->count() > 0)
                            <form id="enroll-form" method="POST" action="{{ route('student.enroll.batch') }}">
                                @csrf
                                <div id="course-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($availableCourses as $course)
                                    <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-4">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="course_{{ $course->course_id }}" name="courses[]" value="{{ $course->course_id }}" class="course-checkbox" data-credits="{{ $course->credits }}">
                                            <label for="course_{{ $course->course_id }}" class="ml-2">
                                                <h4 class="font-semibold ">{{ $course->course_name }}</h4>
                                                <p class="text-sm dark:text-gray-400">{{ $course->credits }} Credits</p>
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="form-error" class="text-red-500 text-sm mt-2" style="display: none;">
                                    Please select at least one course.
                                </div>
                                <div class="mt-4">
                                    <h4 class="font-semibold">Total SKS: <span id="total-credits">0</span></h4>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        Enroll Selected Courses
                                    </button>
                                </div>
                            </form>
                        @else
                            <p class="text-gray-600 dark:text-gray-400">No available courses to enroll in.</p>
                        @endif
                    </div>
                </div>
            </div>

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

<script>
document.addEventListener('DOMContentLoaded', function () {
    // DOM Selector
    const courseCheckboxes = document.querySelectorAll('.course-checkbox');
    const totalCreditsSpan = document.getElementById('total-credits');
    const enrollForm = document.getElementById('enroll-form');
    const formError = document.getElementById('form-error');
    const courseList = document.getElementById('course-list');

    // Event Handling
    courseCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateTotalCredits);
    });

    enrollForm.addEventListener('submit', function (event) {
        const selectedCourses = document.querySelectorAll('.course-checkbox:checked');
        if (selectedCourses.length === 0) {
            event.preventDefault(); // Prevent form submission
            // Form Validation
            formError.style.display = 'block';
            courseList.style.border = '1px solid red';
        } else {
            formError.style.display = 'none';
            courseList.style.border = '';
        }
    });

    function updateTotalCredits() {
        let totalCredits = 0;
        courseCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                totalCredits += parseInt(checkbox.dataset.credits);
            }
        });
        totalCreditsSpan.textContent = totalCredits;
    }

    // DOM Manipulation: createElement
    const newElement = document.createElement('p');
    newElement.textContent = 'This is a new element added with JavaScript.';
    newElement.classList.add('text-sm', 'text-gray-500', 'mt-4');
    enrollForm.appendChild(newElement);

    // Sync vs Async Example
    console.log('Sync: Start');
    setTimeout(() => {
        console.log('Async: This message is displayed after 2 seconds.');
    }, 2000);
    console.log('Sync: End');
});
</script>