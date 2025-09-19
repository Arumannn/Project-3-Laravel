@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-academic-indigo focus:ring-academic-indigo rounded-md shadow-sm']) }}>