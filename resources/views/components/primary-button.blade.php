<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-academic-indigo border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-academic-indigo-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-academic-indigo transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>