<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome, Student!") }}
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="card">
                        <h3 class="card-title">My Courses</h3>
                        <div class="card-content">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-bold text-gray-800">Introduction to Programming</p>
                                        <p class="text-sm text-gray-500">Instructor: Dr. Smith</p>
                                    </div>
                                    <span class="text-green-500 font-semibold">Enrolled</span>
                                </div>
                                </div>
                        </div>
                    </div>

                    </div>

                <div class="space-y-6">
                    <div class="card">
                        <h3 class="card-title">Announcements</h3>
                        <div class="card-content">
                             {{-- Memberi ID pada <ul> ini agar bisa diakses oleh JavaScript --}}
                             <ul id="announcement-list" class="space-y-2">
                                <li class="flex justify-between py-2 border-b last:border-b-0">Platform Update: Scheduled</li>
                                <li class="flex justify-between py-2 border-b last:border-b-0">Reminder: Study Group Tonight</li>
                            </ul>
                            {{-- Tombol untuk demo menambahkan elemen baru --}}
                            <button id="add-announcement-btn" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200 mt-4">
                                Tambah Pengumuman (Demo)
                            </button>
                        </div>
                    </div>

                    <div class="card">
                        <h3 class="card-title">Quick Actions</h3>
                        <div class="card-content">
                            <ul class="space-y-2">
                                <li><a href="#" class="text-blue-500 hover:underline">View Grades</a></li>
                                <li><a href="#" class="text-blue-500 hover:underline">Contact Advisor</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk DOM Manipulation --}}
    <script>
        // 1. Menggunakan querySelector untuk mengakses tombol
        const addButton = document.querySelector('#add-announcement-btn');
        // Menggunakan getElementById untuk mengakses daftar ul
        const announcementList = document.getElementById('announcement-list');

        // 2. Menambahkan event listener 'click' pada tombol
        addButton.addEventListener('click', function() {
            // 3. Membuat elemen <li> baru dengan createElement
            const newAnnouncement = document.createElement('li');

            // 4. Memanipulasi konten dan style dari elemen baru
            // Menambahkan teks
            newAnnouncement.textContent = 'Pengumuman baru telah ditambahkan!';
            // Menambahkan class agar tampilan konsisten dengan item lainnya
            newAnnouncement.className = 'flex justify-between py-2 border-b last:border-b-0';

            // 5. Menambahkan elemen <li> baru ke dalam <ul>
            announcementList.appendChild(newAnnouncement);
        });
    </script>
</x-app-layout>