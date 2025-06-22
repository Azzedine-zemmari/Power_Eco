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
                        <h1 class="text-2xl font-bold text-white">Access Denied</h1>
                    </div>
                    <div class="px-4 py-12 sm:p-12">
                        <div class="flex flex-col items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-24 w-24" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7.5 6C6.11929 6 5 7.11929 5 8.5C5 9.00956 5.15245 9.48351 5.41423 9.87874L8.87874 6.41423C8.48351 6.15245 8.00956 6 7.5 6Z" fill="#ff0000"></path> <path d="M7.5 11C6.99048 11 6.51656 10.8476 6.12135 10.5858L9.58583 7.12135C9.84757 7.51656 10 7.99048 10 8.5C10 9.88071 8.88071 11 7.5 11Z" fill="#ff0000"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M0 2.5C0 1.67157 0.671573 1 1.5 1H5.70711L7.70711 3H13.5C14.3284 3 15 3.67157 15 4.5V12.5C15 13.3284 14.3284 14 13.5 14H1.5C0.671573 14 0 13.3284 0 12.5V2.5ZM4 8.5C4 6.567 5.567 5 7.5 5C9.433 5 11 6.567 11 8.5C11 10.433 9.433 12 7.5 12C5.567 12 4 10.433 4 8.5Z" fill="#ff0000"></path> </g></svg>
                            </div>
                            <div class="mt-6 text-center">
                                <h3 class="text-xl font-medium text-gray-900">Unauthorized Access (403)</h3>
                                <p class="mt-2 text-base text-gray-500">
                                    Sorry, you don't have permission to access this page. Please check your credentials or contact support if you believe this is an error.
                                </p>
                                <div class="mt-8 flex justify-center">
                                    <a href="/" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Return to Home
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 text-sm text-gray-500">
                    <p>If you believe you should have access to this page, please contact our support team at <a href="mailto:support@ecomove.com" class="text-green-600 hover:text-green-500">support@ecomove.com</a></p>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-green-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="mt-8 md:mt-0 md:order-1">
                        <p class="text-center text-base text-green-200">
                            &copy; 2023 EcoMove, Inc. All rights reserved.
                        </p>
                    </div>
            </div>
        </footer>
    </div>
</div>
</template>