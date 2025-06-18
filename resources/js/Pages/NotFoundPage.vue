<template>
<div class="bg-gray-50 text-gray-800 font-sans">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-green-800 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="/" class="flex-shrink-0 flex items-center">
                            <span class="text-white font-bold text-xl">Eco<span class="text-green-300">Move</span></span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <a href="/" class="text-green-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
                        <a href="/products" class="text-green-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Products</a>
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
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-green-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="md:flex md:items-center md:justify-between">
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