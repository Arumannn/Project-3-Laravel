<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Enroll in Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    
                    <form id="enroll-form" action="{{ route('student.enroll.store') }}" method="POST">
                        @csrf

                        <h3 class="text-xl font-semibold mb-4">Select Courses to Enroll</h3>
                        
                        <div id="error-message" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">You must select at least one course before submitting.</span>
                        </div>

                        <div class="border rounded-lg p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @forelse($courses as $course)
                                <div class="flex items-center p-2 rounded-md hover:bg-gray-50">
                                    <input type="checkbox" 
                                           id="course-{{ $course->id }}" 
                                           name="courses[]" 
                                           value="{{ $course->id }}"
                                           class="course-checkbox h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                           data-sks="{{ $course->sks }}">
                                    <label for="course-{{ $course->id }}" class="ml-3 block text-sm font-medium text-gray-700 cursor-pointer">
                                        {{ $course->name }} <span class="text-gray-500">({{ $course->sks }} SKS)</span>
                                    </label>
                                </div>
                            @empty
                                <p class="text-gray-500 col-span-full">There are no new courses available for enrollment.</p>
                            @endforelse
                        </div>

                        <div class="mt-6 p-4 bg-gray-50 rounded-lg text-right flex justify-between items-center">
                            <span class="text-lg font-bold">Total SKS Selected:</span>
                            <span id="total-sks" class="text-2xl font-bold text-indigo-600">0</span>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition-transform transform hover:scale-105">
                                Submit Enrollment
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        // 1. Definisikan semua elemen DOM yang kita butuhkan
        const form = document.getElementById('enroll-form');
        const allCheckboxes = document.querySelectorAll('.course-checkbox');
        const totalSksElement = document.getElementById('total-sks');
        const errorMessage = document.getElementById('error-message');

        /**
         * Fungsi untuk menghitung total SKS dari checkbox yang tercentang.
         */
        function calculateTotalSks() {
            let totalSks = 0;
            // Loop melalui setiap checkbox
            allCheckboxes.forEach(checkbox => {
                // Jika checkbox tercentang
                if (checkbox.checked) {
                    // Ambil nilai SKS dari 'data-sks', ubah ke integer, dan tambahkan ke total
                    totalSks += parseInt(checkbox.dataset.sks, 10);
                }
            });
            // Tampilkan hasilnya di elemen total SKS
            totalSksElement.textContent = totalSks;
        }

        // 2. Tambahkan 'addEventListener' untuk setiap checkbox
        // Saat ada perubahan (dicentang/tidak dicentang), panggil fungsi hitung SKS
        allCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', calculateTotalSks);
        });

        // 3. Tambahkan 'addEventListener' untuk form saat di-submit
        form.addEventListener('submit', function(event) {
            // Cek berapa banyak checkbox yang sedang tercentang
            const checkedCount = document.querySelectorAll('.course-checkbox:checked').length;
            
            // Validasi: Jika tidak ada yang tercentang
            if (checkedCount === 0) {
                // Mencegah form untuk dikirim ke server
                event.preventDefault(); 
                
                // Tampilkan pesan error
                errorMessage.classList.remove('hidden');
                // Scroll ke atas agar pengguna melihat pesan error
                window.scrollTo(0, 0);
            } else {
                // Jika validasi lolos, sembunyikan pesan error (jika sebelumnya tampil)
                errorMessage.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>