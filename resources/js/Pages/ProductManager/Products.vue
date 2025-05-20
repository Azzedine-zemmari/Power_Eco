<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <div class="hidden md:flex md:flex-shrink-0">
                <div class="flex flex-col w-64 bg-green-800">
                    <div class="flex items-center h-16 flex-shrink-0 px-4 bg-green-900">
                        <span class="text-white font-bold text-xl">Eco<span class="text-green-300">Move</span></span>
                    </div>
                    <div class="h-0 flex-1 flex flex-col overflow-y-auto">
                        <!-- User info -->
                        <div class="flex items-center flex-shrink-0 px-4 py-4 border-b border-green-700">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full"
                                    src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="">
                            </div>
                            <div class="ml-3">
                                <p class="text-base font-medium text-white">Michael Roberts</p>
                                <p class="text-sm font-medium text-green-200">Product Manager</p>
                            </div>
                        </div>
                        <!-- Navigation -->
                        <nav class="mt-5 px-2 space-y-1">
                            <a href="product-manager-dashboard.html"
                                class="text-green-100 hover:bg-green-700 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                <svg class="mr-3 h-6 w-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Dashboard
                            </a>

                            <a href="product-manager-categories.html"
                                class="text-green-100 hover:bg-green-700 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                <svg class="mr-3 h-6 w-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                Categories
                            </a>

                            <a href="product-manager-products.html"
                                class="bg-green-700 text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                <svg class="mr-3 h-6 w-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                Products
                            </a>

                            <a href="#"
                                class="text-green-100 hover:bg-green-700 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                <svg class="mr-3 h-6 w-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Analytics
                            </a>

                            <a href="#"
                                class="text-green-100 hover:bg-green-700 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                <svg class="mr-3 h-6 w-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Settings
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
                    <button type="button"
                        class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Top header -->
                <div class="flex-shrink-0 flex h-16 bg-white shadow">
                    <div class="flex-1 px-4 flex justify-between">
                        <div class="flex-1 flex">
                            <h1 class="text-2xl font-semibold text-gray-900 self-center">Products</h1>
                        </div>
                        <div class="ml-4 flex items-center md:ml-6">
                            <!-- Notification dropdown -->
                            <div class="ml-3 relative">
                                <button
                                    class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <span class="sr-only">View notifications</span>
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Profile dropdown -->
                            <div class="ml-3 relative">
                                <div>
                                    <button type="button"
                                        class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full"
                                            src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt="">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <div class="flex justify-between">
                                <h1 class="text-2xl font-semibold text-gray-900">All Products</h1>
                                <button @click="openModal" type="button" id="create-product-btn"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Add New Product
                                </button>
                            </div>
                        </div>
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <!-- Products content -->
                            <div class="py-4">
                                <!-- Search and filter -->
                                <div class="pb-5 border-b border-gray-200 sm:flex sm:items-center sm:justify-between">
                                    <div class="flex-1">
                                        <div class="flex rounded-md shadow-sm max-w-md">
                                            <div class="relative flex-grow focus-within:z-10">
                                                <input type="text" name="search" id="search"
                                                    class="focus:ring-green-500 focus:border-green-500 block w-full rounded-md pl-10 sm:text-sm border-gray-300"
                                                    placeholder="Search products">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 sm:mt-0 sm:ml-4">
                                        <select
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                            <option value="">All Categories</option>
                                            <option value="1">Electric Vehicles</option>
                                            <option value="2">Solar Products</option>
                                            <option value="3">Energy Efficient Appliances</option>
                                            <option value="4">Sustainable Home Products</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Products list -->
                                <div class="mt-8">
                                    <div v-if="loading" class="text-center py-10">
                                        <svg class="animate-spin h-10 w-10 text-green-500 mx-auto"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        <p class="mt-2 text-gray-600">Loading products...</p>
                                    </div>
                                    <div v-else-if="error" class="bg-red-50 p-4 rounded-md">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-red-800">{{ error }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <!-- Grid view for products -->
                                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                                            <!-- Product card -->
                                            <div v-for="product in products" :key="product.id"
                                                class="bg-white overflow-hidden shadow rounded-lg">
                                                <div class="aspect-w-3 aspect-h-2">
                                                    <img class="object-cover w-full h-full"
                                                        :src="`/storage/${product.image}`" alt="Product image">
                                                </div>
                                                <div class="px-4 py-5 sm:p-6">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900">{{
                                                        product.name }}</h3>
                                                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                                                        <p>{{ product.description }}</p>
                                                    </div>
                                                    <div class="mt-3 flex items-center">
                                                        <span class="text-2xl font-bold text-gray-900">${{ product.price
                                                            }}</span>
                                                        <span v-if="product.old_price"
                                                            class="ml-2 text-sm line-through text-gray-500">${{
                                                            product.old_price }}</span>
                                                    </div>
                                                    <div class="mt-2">
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            {{ product.category }}
                                                        </span>
                                                        <span v-if="product.stock > 0"
                                                            class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                            In Stock: {{ product.stock }}
                                                        </span>
                                                        <span v-else
                                                            class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                            Out of Stock
                                                        </span>
                                                    </div>
                                                    <div class="mt-5 flex space-x-3">
                                                        <button @click="editProduct(product)"
                                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                            <svg class="-ml-0.5 mr-2 h-4 w-4"
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                fill="currentColor">
                                                                <path
                                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                            </svg>
                                                            Edit
                                                        </button>
                                                        <button @click="confirmDelete(product)"
                                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                            <svg class="-ml-0.5 mr-2 h-4 w-4"
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Empty state -->
                                        <div v-if="products.length === 0" class="text-center py-12">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <h3 class="mt-2 text-sm font-medium text-gray-900">No products</h3>
                                            <p class="mt-1 text-sm text-gray-500">Get started by creating a new product.
                                            </p>
                                            <div class="mt-6">
                                                <button @click="openModal" type="button"
                                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Add Product
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!-- Add/Edit Product Modal -->
        <div v-if="isModalOpen" class="fixed z-10 inset-0 overflow-y-auto" id="product-modal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" id="modal-backdrop"></div>

                <!-- Modal panel -->
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    {{ isEditing ? 'Edit Product' : 'Add New Product' }}
                                </h3>
                                <div class="mt-4">
                                    <form @submit.prevent="submitProduct" id="product-form" class="space-y-6">
                                        <input type="hidden" v-model="productForm.id">

                                        <!-- Product Name -->
                                        <div>
                                            <label for="product-name"
                                                class="block text-sm font-medium text-gray-700">Product Name</label>
                                            <div class="mt-1">
                                                <input v-model="productForm.name" type="text" id="product-name"
                                                    name="product-name" required
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                <div v-if="errors.name" class="text-red-500 text-sm mt-1">{{
                                                    errors.name[0] }}</div>
                                            </div>
                                        </div>

                                        <!-- Product Description -->
                                        <div>
                                            <label for="product-description"
                                                class="block text-sm font-medium text-gray-700">Description</label>
                                            <div class="mt-1">
                                                <textarea v-model="productForm.description" id="product-description"
                                                    name="product-description" rows="3"
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                                                <div v-if="errors.description" class="text-red-500 text-sm mt-1">{{
                                                    errors.description[0] }}</div>
                                            </div>
                                        </div>

                                        <!-- Price and Stock -->
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label for="product-price"
                                                    class="block text-sm font-medium text-gray-700">Price ($)</label>
                                                <div class="mt-1">
                                                    <input v-model="productForm.price" type="number" step="0.01"
                                                        id="product-price" name="product-price" required
                                                        class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    <div v-if="errors.price" class="text-red-500 text-sm mt-1">{{
                                                        errors.price[0] }}</div>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="product-stock"
                                                    class="block text-sm font-medium text-gray-700">Stock</label>
                                                <div class="mt-1">
                                                    <input v-model="productForm.stock" type="number" id="product-stock"
                                                        name="product-stock" required
                                                        class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    <div v-if="errors.stock" class="text-red-500 text-sm mt-1">{{
                                                        errors.stock[0] }}</div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Category -->
                                        <div>
                                            <label for="product-category"
                                                class="block text-sm font-medium text-gray-700">Category</label>
                                            <div class="mt-1">
                                                <select v-model="productForm.category_id" id="product-category"
                                                    name="product-category" required
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    <option value="">Select a category</option>
                                                    <option v-for="category in categories" :key="category.id"
                                                        :value="category.id">
                                                        {{ category.name }}
                                                    </option>
                                                </select>
                                                <div v-if="errors.category_id" class="text-red-500 text-sm mt-1">{{
                                                    errors.category_id[0] }}</div>
                                            </div>
                                        </div>

                                        <!-- Product Image -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Product Image</label>
                                            <div class="mt-1 flex items-center">
                                                <div v-if="productForm.imagePreview"
                                                    class="flex-shrink-0 h-16 w-16 bg-gray-100 rounded-md overflow-hidden">
                                                    <img :src="productForm.imagePreview" alt="Product preview"
                                                        class="h-full w-full object-cover">
                                                </div>
                                                <div v-else
                                                    class="flex-shrink-0 h-16 w-16 bg-gray-100 rounded-md flex items-center justify-center">
                                                    <svg class="h-8 w-8 text-gray-300" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                    </svg>
                                                </div>
                                                <div class="ml-4 flex">
                                                    <div
                                                        class="relative bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm flex items-center cursor-pointer hover:bg-gray-50 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                                        <label for="product-image"
                                                            class="relative text-sm font-medium text-gray-700 pointer-events-none">
                                                            <span>Change</span>
                                                            <span class="sr-only"> product image</span>
                                                        </label>
                                                        <input id="product-image" name="product-image" type="file"
                                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer border-gray-300 rounded-md"
                                                            @change="handleImageChange">
                                                    </div>
                                                    <button v-if="productForm.image" type="button"
                                                        class="ml-3 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                                        @click="removeImage">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                            <div v-if="errors.image" class="text-red-500 text-sm mt-1">{{
                                                errors.image[0] }}</div>
                                        </div>

                                        <!-- Status -->
                                        <div>
                                            <label for="product-status"
                                                class="block text-sm font-medium text-gray-700">Status</label>
                                            <div class="mt-1">
                                                <select v-model="productForm.status" id="product-status"
                                                    name="product-status"
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                    <option value="draft">Draft</option>
                                                </select>
                                                <div v-if="errors.status" class="text-red-500 text-sm mt-1">{{
                                                    errors.status[0] }}</div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" @click="submitProduct" id="save-product-btn"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ isEditing ? 'Update Product' : 'Save Product' }}
                        </button>
                        <button type="button" @click="closeModal" id="cancel-product-btn"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div v-if="isDeleteModalOpen" class="fixed z-10 inset-0 overflow-y-auto" id="delete-confirmation-modal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" id="delete-modal-backdrop">
                </div>

                <!-- Modal panel -->
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Product</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Are you sure you want to delete this product? This action cannot be undone.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" @click="deleteProduct" id="confirm-delete-btn"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Delete
                        </button>
                        <button type="button" @click="closeDeleteModal" id="cancel-delete-btn"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, reactive } from 'vue';
import axios from 'axios';

// State variables
const isModalOpen = ref(false);
const isDeleteModalOpen = ref(false);
const isEditing = ref(false);
const loading = ref(true);
const error = ref(null);
const products = ref([]);
const categories = ref([]);
const selectedProduct = ref(null);
const errors = ref({});

// Form state
const productForm = reactive({
    id: null,
    name: '',
    description: '',
    price: '',
    stock: '',
    category_id: '',
    image: null,
    imagePreview: null,
    status: 'active'
});

// Get token from localStorage
const token = localStorage.getItem('token');

// Modal functions
function openModal() {
    isModalOpen.value = true;
    isEditing.value = false;
    resetForm();
}

function closeModal() {
    isModalOpen.value = false;
    errors.value = {};
}

function editProduct(product) {
    isEditing.value = true;
    productForm.id = product.id;
    productForm.name = product.name;
    productForm.description = product.description;
    productForm.price = product.price;
    productForm.stock = product.stock;
    productForm.category_id = product.category_id;
    productForm.image = product.image;
    productForm.status = product.status || 'active';
    isModalOpen.value = true;
}

function resetForm() {
    productForm.id = null;
    productForm.name = '';
    productForm.description = '';
    productForm.price = '';
    productForm.stock = '';
    productForm.category_id = '';
    productForm.image = null;
    productForm.status = 'active';
}

function confirmDelete(product) {
    selectedProduct.value = product;
    isDeleteModalOpen.value = true;
}

function closeDeleteModal() {
    isDeleteModalOpen.value = false;
    selectedProduct.value = null;
}

// Image handling
function handleImageChange(event) {
    const file = event.target.files[0];
    if (file) {
        console.log(file.name)
        productForm.image = file
        // In a real app, you would upload this to your server
        // For now, we'll just create a data URL for preview
        const reader = new FileReader();
        reader.onload = (e) => {
            productForm.imagePreview = e.target.result;
            console.log(productForm.imagePreview)
                };
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    productForm.image = null;
}

// API functions
async function fetchProducts() {
    try {
        loading.value = true;
        error.value = null;

        // This would be your actual API endpoint
        const response = await axios.get('http://localhost:8000/api/products', {
            withCredentials: true,
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${token}`
            }
        });

        products.value = response.data || [];
    } catch (err) {
        error.value = 'Failed to load products';
        console.error(err);
    } finally {
        loading.value = false;
    }
}

async function fetchCategories() {
    try {
        const response = await axios.get('http://localhost:8000/api/categories', {
            withCredentials: true,
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${token}`
            }
        });
        categories.value = response.data || [];
    } catch (err) {
        console.error('Failed to load categories:', err);
    }
}

async function submitProduct() {
    try {
        errors.value = {};

        // Get CSRF cookie from Laravel Sanctum
        await axios.get('http://localhost:8000/sanctum/csrf-cookie', { withCredentials: true });

        const url = isEditing.value
            ? `http://localhost:8000/api/products/${productForm.id}/update`
            : 'http://localhost:8000/api/products/create';

        const method = isEditing.value ? 'put' : 'post';

        const formData = new FormData();
        formData.append('name', productForm.name);
        formData.append('description', productForm.description);
        formData.append('price', productForm.price);
        formData.append('stock', productForm.stock);
        formData.append('categorie_id', productForm.category_id);
        formData.append('status', productForm.status);

        if (productForm.image) {
            formData.append('image', productForm.image); 
        }

        if (isEditing.value) {
            formData.append('_method', 'PUT'); 
        }

        const response = await axios[method](
            url,
            formData,
            {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                }
            }
        );

        closeModal();
        await fetchProducts();

    } catch (err) {
        if (err.response && err.response.data && err.response.data.errors) {
            errors.value = err.response.data.errors;
        } else {
            console.error('Error submitting product:', err);
        }
    }
}

async function deleteProduct() {
    if (!selectedProduct.value) return;

    try {
        // Get CSRF cookie from Laravel Sanctum
        await axios.get('http://localhost:8000/sanctum/csrf-cookie', { withCredentials: true });

        await axios.delete(`http://localhost:8000/api/products/${selectedProduct.value.id}/delete`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
            }
        });

        closeDeleteModal();
        await fetchProducts();

    } catch (err) {
        console.error('Error deleting product:', err);
    }
}

// Initialize
onMounted(() => {
    fetchProducts();
    fetchCategories();
});
</script>