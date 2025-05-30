<template>
        <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex-shrink-0 flex items-center">
                        <span class="text-green-600 font-bold text-xl">Eco<span class="text-green-800">Move</span></span>
                    </a>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="/" class="border-green-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Home
                        </a>
                        <a href="/products" class="border-transparent text-gray-500 hover:border-green-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Products
                        </a>
                        <a href="about.html" class="border-transparent text-gray-500 hover:border-green-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            About Us
                        </a>
                        <a href="contact.html" class="border-transparent text-gray-500 hover:border-green-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Contact
                        </a>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <div class="ml-4 flex items-center md:ml-6">
                        <a href="/cart" class="p-1 rounded-full text-gray-600 hover:text-gray-800 focus:outline-none">
                            <span class="sr-only">View cart</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </a>
                        <LogoutButton variant="default"/>
                    </div>
                </div>
                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu, show/hide based on menu state -->
        <div class="sm:hidden hidden">
            <div class="pt-2 pb-3 space-y-1">
                <a href="/" class="bg-green-50 border-green-500 text-green-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Home
                </a>
                <a href="/products" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-green-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Products
                </a>
                <a href="about.html" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-green-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    About Us
                </a>
                <a href="contact.html" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-green-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Contact
                </a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <svg class="h-10 w-10 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <a href="login.html" class="text-base font-medium text-gray-800 hover:text-gray-900">Sign in</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>