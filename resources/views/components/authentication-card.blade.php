<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div style="backdrop-filter:blur(3px) brightness(130%);" class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg">
        <div class="mb-5">
            {{ $logo }}
        </div>

        {{ $slot }}
    </div>
</div>
