@props(['active'])

@php
// Kelas ini diubah untuk mendukung layout sidebar vertikal
$classes = ($active ?? false)
            // Style untuk link yang sedang aktif: latar belakang berwarna
            ? 'flex flex-col items-center w-full p-3 rounded-lg bg-gray-200 text-gray-900 font-bold transition-colors duration-150'
            // Style untuk link normal
            : 'flex flex-col items-center w-full p-3 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>