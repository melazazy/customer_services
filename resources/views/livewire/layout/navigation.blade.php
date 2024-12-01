<nav x-data="{ isScrolled: false, isOpen: false }" 
    @scroll.window="isScrolled = (window.pageYOffset > 20)"
    :class="{ 'bg-gray-800 shadow-lg': isScrolled, 'bg-transparent': !isScrolled }"
    class="fixed w-full z-50 transition-all duration-300">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-white">
                Creative<span class="text-primary-red">Services</span>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="text-white hover:text-primary-red transition-colors">Home</a>
                <a href="#services" class="text-white hover:text-primary-red transition-colors">Services</a>
                <a href="#about" class="text-white hover:text-primary-red transition-colors">About</a>
                <a href="#contact" class="text-white hover:text-primary-red transition-colors">Contact</a>
                
                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    <a href="/login" class="text-white hover:text-primary-red transition-colors">Login</a>
                    <a href="/register" class="bg-primary-red text-white px-6 py-2 rounded-full hover:bg-secondary-red transition-colors">Register</a>
                </div>
            </div>

            <!-- Mobile Navigation Button -->
            <button @click="isOpen = !isOpen" 
                    class="md:hidden focus:outline-none text-white"
                    aria-label="Toggle navigation">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="isOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#home" class="block px-3 py-2 text-white hover:text-primary-red transition-colors">Home</a>
                <a href="#services" class="block px-3 py-2 text-white hover:text-primary-red transition-colors">Services</a>
                <a href="#about" class="block px-3 py-2 text-white hover:text-primary-red transition-colors">About</a>
                <a href="#contact" class="block px-3 py-2 text-white hover:text-primary-red transition-colors">Contact</a>
                
                <!-- Mobile Auth Links -->
                <div class="pt-4 border-t border-gray-700 space-y-2">
                    <a href="/login" class="block px-3 py-2 text-white hover:text-primary-red transition-colors">Login</a>
                    <a href="/register" class="block bg-primary-red text-white px-6 py-2 rounded-full hover:bg-secondary-red transition-colors text-center mx-3">Register</a>
                </div>
            </div>
        </div>
    </div>
</nav>
