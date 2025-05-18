<template>
<div class="bg-gray-50 text-gray-800 font-sans">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="index.html" class="flex-shrink-0 flex items-center">
                        <span class="text-green-600 font-bold text-xl">Eco<span class="text-green-800">Move</span></span>
                    </a>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="index.html" class="border-green-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Home
                        </a>
                        <a href="products.html" class="border-transparent text-gray-500 hover:border-green-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
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
                        <a href="cart.html" class="p-1 rounded-full text-gray-600 hover:text-gray-800 focus:outline-none">
                            <span class="sr-only">View cart</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </a>
                        <LogoutButton/>
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
                <a href="index.html" class="bg-green-50 border-green-500 text-green-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Home
                </a>
                <a href="products.html" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-green-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
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

    <!-- Hero Section -->
    <div class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100" />
                </svg>
                <div class="pt-10 sm:pt-16 lg:pt-8 lg:pb-14 lg:overflow-hidden">
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div class="lg:grid lg:grid-cols-2 lg:gap-8">
                            <div class="mx-auto max-w-md px-4 sm:max-w-2xl sm:px-6 sm:text-center lg:px-0 lg:text-left lg:flex lg:items-center">
                                <div class="lg:py-24">
                                    <h1 class="mt-4 text-4xl tracking-tight font-extrabold text-gray-900 sm:mt-5 sm:text-5xl lg:mt-6 xl:text-6xl">
                                        <span class="block">Sustainable Solutions</span>
                                        <span class="block text-green-600">for a Greener Future</span>
                                    </h1>
                                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                                        Discover our range of eco-friendly products designed to reduce your carbon footprint and promote sustainable living.
                                    </p>
                                    <div class="mt-8 sm:mt-12">
                                        <a href="products.html" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            Shop Now
                                        </a>
                                        <a href="about.html" class="ml-4 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            Learn More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1497440001374-f26997328c1b?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Solar panels on a green field">
        </div>
    </div>

    <!-- Featured Categories -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto py-16 sm:py-24 lg:py-32 lg:max-w-none">
                <h2 class="text-3xl font-extrabold text-gray-900">Featured Categories</h2>
                <div class="mt-6 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-x-6">
                    <div class="group relative">
                        <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                            <img src="https://images.unsplash.com/photo-1509391366360-2e959784a276?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1052&q=80" alt="Solar Panels" class="w-full h-full object-center object-cover">
                        </div>
                        <h3 class="mt-6 text-sm text-gray-500">
                            <a href="products.html">
                                <span class="absolute inset-0"></span>
                                Energy Solutions
                            </a>
                        </h3>
                        <p class="text-base font-semibold text-gray-900">Solar Panels & Home Energy</p>
                    </div>

                    <div class="group relative">
                        <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                            <img src="https://images.unsplash.com/photo-1571068316344-75bc76f77890?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Electric Bikes" class="w-full h-full object-center object-cover">
                        </div>
                        <h3 class="mt-6 text-sm text-gray-500">
                            <a href="products.html">
                                <span class="absolute inset-0"></span>
                                Sustainable Transport
                            </a>
                        </h3>
                        <p class="text-base font-semibold text-gray-900">Electric Bikes & Scooters</p>
                    </div>

                    <div class="group relative">
                        <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1013&q=80" alt="Eco Gadgets" class="w-full h-full object-center object-cover">
                        </div>
                        <h3 class="mt-6 text-sm text-gray-500">
                            <a href="products.html">
                                <span class="absolute inset-0"></span>
                                Smart Living
                            </a>
                        </h3>
                        <p class="text-base font-semibold text-gray-900">Eco-Friendly Gadgets</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto py-16 sm:py-24 lg:py-32 lg:max-w-none">
                <h2 class="text-3xl font-extrabold text-gray-900">Featured Products</h2>
                <div class="mt-6 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-4 lg:gap-x-6">
                    <!-- Product 1 -->
                    <div class="group relative">
                        <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                            <img src="https://images.unsplash.com/photo-1522107177-01884fcef41f?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Solar Panel Kit" class="w-full h-full object-center object-cover">
                        </div>
                        <h3 class="mt-6 text-sm text-gray-500">
                            <a href="product-detail.html">
                                <span class="absolute inset-0"></span>
                                Home Energy
                            </a>
                        </h3>
                        <p class="text-base font-semibold text-gray-900">Premium Solar Panel Kit</p>
                        <p class="mt-1 text-sm text-gray-500">Starting from $899</p>
                    </div>

                    <!-- Product 2 -->
                    <div class="group relative">
                        <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                            <img src="https://images.unsplash.com/photo-1558981852-426c6c22a060?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Electric Bike" class="w-full h-full object-center object-cover">
                        </div>
                        <h3 class="mt-6 text-sm text-gray-500">
                            <a href="product-detail.html">
                                <span class="absolute inset-0"></span>
                                Mobility
                            </a>
                        </h3>
                        <p class="text-base font-semibold text-gray-900">Urban Electric Bike</p>
                        <p class="mt-1 text-sm text-gray-500">$1,299</p>
                    </div>

                    <!-- Product 3 -->
                    <div class="group relative">
                        <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                            <img src="https://images.unsplash.com/photo-1564424224827-cd24b8915874?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1489&q=80" alt="Smart Thermostat" class="w-full h-full object-center object-cover">
                        </div>
                        <h3 class="mt-6 text-sm text-gray-500">
                            <a href="product-detail.html">
                                <span class="absolute inset-0"></span>
                                Smart Home
                            </a>
                        </h3>
                        <p class="text-base font-semibold text-gray-900">Eco Smart Thermostat</p>
                        <p class="mt-1 text-sm text-gray-500">$199</p>
                    </div>

                    <!-- Product 4 -->
                    <div class="group relative">
                        <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                            <img src="https://images.unsplash.com/photo-1560343776-97e7d202ff0e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1051&q=80" alt="Solar Charger" class="w-full h-full object-center object-cover">
                        </div>
                        <h3 class="mt-6 text-sm text-gray-500">
                            <a href="product-detail.html">
                                <span class="absolute inset-0"></span>
                                Gadgets
                            </a>
                        </h3>
                        <p class="text-base font-semibold text-gray-900">Portable Solar Charger</p>
                        <p class="mt-1 text-sm text-gray-500">$79</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sustainability Section -->
    <div class="bg-green-700">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">Ready to go green?</span>
                <span class="block text-green-200">Start your sustainable journey today.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="products.html" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-green-600 bg-white hover:bg-green-50">
                        Shop Products
                    </a>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="about.html" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white">
        <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
            <nav class="-mx-5 -my-2 flex flex-wrap justify-center" aria-label="Footer">
                <div class="px-5 py-2">
                    <a href="index.html" class="text-base text-gray-500 hover:text-gray-900">
                        Home
                    </a>
                </div>

                <div class="px-5 py-2">
                    <a href="products.html" class="text-base text-gray-500 hover:text-gray-900">
                        Products
                    </a>
                </div>

                <div class="px-5 py-2">
                    <a href="about.html" class="text-base text-gray-500 hover:text-gray-900">
                        About Us
                    </a>
                </div>

                <div class="px-5 py-2">
                    <a href="contact.html" class="text-base text-gray-500 hover:text-gray-900">
                        Contact
                    </a>
                </div>

                <div class="px-5 py-2">
                    <a href="#" class="text-base text-gray-500 hover:text-gray-900">
                        Blog
                    </a>
                </div>
            </nav>
            <div class="mt-8 flex justify-center space-x-6">
                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Facebook</span>
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                    </svg>
                </a>

                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Instagram</span>
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                    </svg>
                </a>

                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Twitter</span>
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                    </svg>
                </a>
            </div>
            <p class="mt-8 text-center text-base text-gray-400">
                &copy; 2023 EcoMove, Inc. All rights reserved.
            </p>
        </div>
    </footer>
</div>
</template>
<script setup>
import LogoutButton from '../components/LogoutButton.vue';
</script>