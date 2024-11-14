<nav class="px-8 py-6">
    <div class="max-w-5xl mx-auto bg-white rounded-full shadow-md px-6 py-2 flex justify-between items-center">
        <!-- Logo -->
        <div class="w-12 h-12"> 
            <img src="{{ asset('images/bertasaLogo.png') }}" alt="Logo" class="w-full h-full object-contain">
        </div>
        
        <!-- Navigation Links -->
        <div class="flex gap-12 font-semibold text-lg"> 
            <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                Home
            </x-nav-link>
            <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">
                About
            </x-nav-link>
            <x-nav-link href="{{ route('finger-speech') }}" :active="request()->routeIs('finger-speech')">
                Finger Speech
            </x-nav-link>
            <x-nav-link href="{{ route('faq') }}" :active="request()->routeIs('faq')">
                FAQ
            </x-nav-link>
        </div>
    </div>
</nav>