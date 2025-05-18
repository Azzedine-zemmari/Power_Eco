<template>
<div class="bg-gray-50 text-gray-800 font-sans">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-green-800 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="index.html" class="flex-shrink-0 flex items-center">
                            <span class="text-white font-bold text-xl">Eco<span class="text-green-300">Move</span></span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <a href="index.html" class="text-green-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
                        <a href="products.html" class="text-green-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Products</a>
                        <a href="#" class="text-green-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium">About</a>
                        <a href="#" class="text-green-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main content -->
        <main class="flex-grow flex items-center justify-center">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
                <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                    <div class="bg-green-700 px-4 py-5 sm:px-6">
                        <h1 class="text-2xl font-bold text-white">Page Not Found</h1>
                    </div>
                    <div class="px-4 py-12 sm:p-12">
                        <div class="flex flex-col items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-24 w-24 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="mt-6 text-center">
                                <h3 class="text-xl font-medium text-gray-900">404 - Page Not Found</h3>
                                <p class="mt-2 text-base text-gray-500">
                                    Oops! The page you're looking for doesn't exist or has been moved.
                                </p>
                                <div class="mt-8 flex justify-center">
                                    <a href="/" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Return to Home
                                    </a>
                                    <a href="products.html" class="ml-4 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Browse Products
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <h2 class="text-lg font-medium text-gray-900">Looking for something specific?</h2>
                    <div class="mt-4 max-w-md mx-auto">
                        <div class="relative rounded-md shadow-sm">
                            <input type="text" name="search" id="search" class="focus:ring-green-500 focus:border-green-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md" placeholder="Search for products...">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900">Popular Categories</h3>
                    <div class="mt-4 flex flex-wrap justify-center gap-2">
                        <a href="#" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full text-green-700 bg-green-100 hover:bg-green-200">
                            Electric Vehicles
                        </a>
                        <a href="#" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full text-green-700 bg-green-100 hover:bg-green-200">
                            Solar Products
                        </a>
                        <a href="#" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full text-green-700 bg-green-100 hover:bg-green-200">
                            Energy Efficient Appliances
                        </a>
                        <a href="#" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full text-green-700 bg-green-100 hover:bg-green-200">
                            Sustainable Home Products
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-green-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="flex justify-center md:order-2 space-x-6">
                        <a href="#" class="text-green-200 hover:text-white">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-green-200 hover:text-white">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-green-200 hover:text-white">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </div>
                    <div class="mt-8 md:mt-0 md:order-1">
                        <p class="text-center text-base text-green-200">
                            &copy; 2023 EcoMove, Inc. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
</template>