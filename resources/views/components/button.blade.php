<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-secondary inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:text-white hover:bg-primary focus:bg-primary active:bg-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
