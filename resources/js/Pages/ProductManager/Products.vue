<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <div class="flex h-screen overflow-hidden">
            <Sidebar />

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
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">All Products</h1>
                <div class="flex space-x-3">
                    <!-- Import Products Button -->
                    <button @click="toggleImportSection" type="button"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        Import Products
                    </button>
                    
                    <!-- Add New Product Button -->
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
        </div>

        <!-- Import Products Section (Collapsible) -->
        <div v-if="showImportSection" class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 mt-6">
            <div class="bg-white shadow rounded-lg border border-gray-200">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Import Products from Excel</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Upload an Excel file (.xlsx, .xls) or CSV file to import multiple products at once.
                            </p>
                        </div>
                        <button @click="showImportSection = false" type="button"
                            class="text-gray-400 hover:text-gray-500">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form @submit.prevent="importProducts" class="space-y-4">
                        <!-- File Upload Area -->
                        <div class="flex items-center justify-center w-full">
                            <label for="excel-file" 
                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200"
                                :class="{ 'border-green-400 bg-green-50': file }">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg v-if="!file" class="w-8 h-8 mb-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <svg v-else class="w-8 h-8 mb-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p v-if="!file" class="mb-2 text-sm text-gray-500">
                                        <span class="font-semibold">Click to upload</span> or drag and drop
                                    </p>
                                    <p v-else class="mb-2 text-sm text-green-600 font-semibold">
                                        {{ file.name }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ file ? `${(file.size / 1024 / 1024).toFixed(2)} MB` : 'XLSX, XLS or CSV (MAX. 10MB)' }}
                                    </p>
                                </div>
                                <input id="excel-file" type="file" class="hidden" @change="handleFile" accept=".xlsx,.xls,.csv">
                            </label>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <button v-if="file" @click="clearFile" type="button"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="-ml-0.5 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Clear File
                                </button>
                                
                                <a href="#" class="text-sm text-green-600 hover:text-green-500 font-medium">
                                    Download Sample Template
                                </a>
                            </div>

                            <button type="submit" :disabled="!file || importing"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                <svg v-if="!importing" class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <svg v-else class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ importing ? 'Importing...' : 'Import Products' }}
                            </button>
                        </div>

                        <!-- Help Information -->
                        <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">Import Guidelines</h3>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            <li><strong>Required columns:</strong> name, description, price, stock, categorie_id, marge, sell_price, status, image</li>
                                            <li><strong>File size limit:</strong> Maximum 10MB</li>
                                            <li><strong>Supported formats:</strong> .xlsx, .xls, .csv</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
                                                <input type="text" name="search" id="search" v-model="searchQuery"
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
                                    <div class="mt-3 sm:mt-0 sm:ml-4 flex space-x-2 items-center">
                                        <select v-model="selectedCategoryFilter"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                            <option value="" selected disabled>All Categories</option>
                                            <option v-for="category in categories" :key="category.id"
                                                :value="category.id">{{ category.name }}</option>
                                        </select>
                                        <!-- Price filter inputs -->
                                        <input v-model="minPriceFilter" type="number" step="0.01" placeholder="Min Price"
                                            class="mt-1 block w-24 pl-3 pr-2 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md" />
                                        <span class="mx-1 text-gray-500">-</span>
                                        <input v-model="maxPriceFilter" type="number" step="0.01" placeholder="Max Price"
                                            class="mt-1 block w-24 pl-3 pr-2 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md" />
                                        <!-- Stock filter text inputs -->
                                        <input v-model="minStockFilter" type="number" step="1" placeholder="Min Stock"
                                            class="mt-1 block w-24 pl-3 pr-2 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md" />
                                        <span class="mx-1 text-gray-500">-</span>
                                        <input v-model="maxStockFilter" type="number" step="1" placeholder="Max Stock"
                                            class="mt-1 block w-24 pl-3 pr-2 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md" />
                                    </div>
                                    <button v-if="selectedCategoryFilter || minPriceFilter || maxPriceFilter" @click="resetFilters"
                                        class="ml-2 inline-flex items-center px-2 py-1 border border-transparent text-xs leading-4 font-medium rounded text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <svg class="mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Clear filter
                                    </button>

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
                                            <div v-for="product in filteredProducts" :key="product.id"
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
                                                    <input v-model="productForm.price" @input="countMarge" type="number" step="0.01"
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
                                        <!-- marge & prix de vente  -->
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label for="product-marge"
                                                    class="block text-sm font-medium text-gray-700">Marge (%)</label>
                                                <div class="mt-1">
                                                    <input v-model="productForm.marge" @input="countMarge" type="number"
                                                        id="product-marge" name="product-marge" required
                                                        class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    <div v-if="errors.marge" class="text-red-500 text-sm mt-1">{{
                                                        errors.marge[0] }}</div>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="product-SellPrice"
                                                    class="block text-sm font-medium text-gray-700">Sell Price</label>
                                                <div class="mt-1">
                                                    <input v-model="productForm.Sprice" @input="countMarge" type="number" id="product-SellPrice"
                                                        name="product-SellPrice" required
                                                        class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    <div v-if="errors.Sprice" class="text-red-500 text-sm mt-1">{{
                                                        errors.Sprice[0] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Category -->
                                        <div>
                                            <label for="product-category"
                                                class="block text-sm font-medium text-gray-700">Category</label>
                                            <div class="mt-1">
                                                <select v-model="productForm.categorie_id" id="product-category"
                                                    name="product-category" required
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    <option value="">Select a category</option>
                                                    <option v-for="category in categories" :key="category.id"
                                                        :value="category.id">
                                                        {{ category.name }}
                                                    </option>
                                                </select>
                                                <div v-if="errors.categorie_id" class="text-red-500 text-sm mt-1">{{
                                                    errors.categorie_id[0] }}</div>
                                            </div>
                                        </div>

                                        <!-- Product Image -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Product Image</label>
                                            <div class="mt-1 flex items-center">
                                                <div v-if="isEditing">
                                                    <div v-if="productForm.imagePreview"
                                                        class="flex-shrink-0 h-16 w-16 bg-gray-100 rounded-md overflow-hidden">
                                                        <img :src="`/storage/${productForm.imagePreview}`"
                                                            alt="Product preview" class="h-full w-full object-cover">
                                                    </div>
                                                    <div v-else
                                                        class="flex-shrink-0 h-16 w-16 bg-gray-100 rounded-md flex items-center justify-center">
                                                        <svg class="h-8 w-8 text-gray-300" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div v-else>
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
                                                </div>

                                                <div class="ml-4 flex">
                                                    <div
                                                        class="relative bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm flex items-center cursor-pointer hover:bg-gray-50 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                                        <label for="product-image"
                                                            class="relative text-sm font-medium text-gray-700 pointer-events-none">
                                                            <span>Change</span>
                                                            <span class="sr-only"> product image</span>
                                                        </label>
                                                        <input id="product-image" name="image" type="file"
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
import { ref, onMounted, reactive, computed } from 'vue';
import axios from 'axios';
import LogoutButton from '../../components/LogoutButton.vue';
import Sidebar from '../../components/Sidebar.vue';

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
const selectedCategoryFilter = ref('');
const minPriceFilter = ref('');
const maxPriceFilter = ref('');
const minStockFilter = ref('');
const maxStockFilter = ref('10000');
const searchQuery = ref('');

// Form state
const productForm = reactive({
    id: null,
    name: '',
    description: '',
    price: 0,
    stock: '',
    marge:0,
    Sprice:0,
    categorie_id: '',
    image: null,
    imagePreview: null,
    imageFile: null,
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
    productForm.categorie_id = product.categorie_id;
    productForm.status = product.status || 'active';

    // For existing image, store the URL/path but not as a file
    if (product.image) {
        productForm.image = product.image; // Store the image path/URL
        productForm.imagePreview = product.image; // Use the same for preview
        productForm.imageFile = null; // No file yet unless user uploads a new one
    } else {
        productForm.image = null;
        productForm.imagePreview = null;
        productForm.imageFile = null;
    }

    isModalOpen.value = true;
}

function resetForm() {
    productForm.id = null;
    productForm.name = '';
    productForm.description = '';
    productForm.price = '';
    productForm.stock = '';
    productForm.categorie_id = '';
    productForm.image = null;
    productForm.imagePreview = null;
    productForm.imageFile = null;
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

function handleImageChange(event) {
    const file = event.target.files[0];
    if (file) {
        // Store the actual file object
        productForm.imageFile = file;

        // Create a preview URL for display
        productForm.imagePreview = URL.createObjectURL(file);
    }
}

function removeImage() {
    productForm.imageFile = null;
    productForm.imagePreview = null;
    productForm.image = null; // Clear the existing image path as well
}

// API functions
async function fetchProducts() {
    try {
        loading.value = true;
        error.value = null;

        // This would be your actual API endpoint
        const response = await axios.get('http://localhost:8000/api/product-manager/products', {
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

        const method = isEditing.value ? 'post' : 'post';

        const formData = new FormData();
        formData.append('name', productForm.name);
        formData.append('description', productForm.description);
        formData.append('price', productForm.price);
        formData.append('sell_price',productForm.Sprice);
        formData.append('marge',productForm.marge);
        formData.append('stock', productForm.stock);
        formData.append('categorie_id', productForm.categorie_id);
        formData.append('status', productForm.status);

        console.log(productForm.categorie_id)
        // Only append image if there's a new file selected
        if (productForm.imageFile) {
            formData.append('image', productForm.imageFile);
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
                    'Content-Type': 'multipart/form-data' // Important for file uploads
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

        await axios.post(`http://localhost:8000/api/products/${selectedProduct.value.id}/delete`, {
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

// Create a computed property for filtered products
const filteredProducts = computed(() => {
    let filtered = products.value;

    // Search filter
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        filtered = filtered.filter(product => 
            product.name.toLowerCase().includes(query) ||
            product.description.toLowerCase().includes(query)
        );
    }

    // Category filter
    if (selectedCategoryFilter.value && selectedCategoryFilter.value !== '') {
        filtered = filtered.filter(product => product.categorie_id == selectedCategoryFilter.value);
    }

    // Price filter
    const min = parseFloat(minPriceFilter.value);
    const max = parseFloat(maxPriceFilter.value);
    if (!isNaN(min)) {
        filtered = filtered.filter(product => parseFloat(product.price) >= min);
    }
    if (!isNaN(max)) {
        filtered = filtered.filter(product => parseFloat(product.price) <= max);
    }

    // Stock filter (min and max)
    const minStock = parseInt(minStockFilter.value);
    const maxStock = parseInt(maxStockFilter.value);
    if (!isNaN(minStock)) {
        filtered = filtered.filter(product => parseInt(product.stock) >= minStock);
    }
    if (!isNaN(maxStock) && maxStock < 10000) {
        filtered = filtered.filter(product => parseInt(product.stock) <= maxStock);
    }

    return filtered;
});

// Function to reset filters
function resetFilters() {
    selectedCategoryFilter.value = '';
    minPriceFilter.value = '';
    maxPriceFilter.value = '';
    minStockFilter.value = '';
    maxStockFilter.value = '10000';
    searchQuery.value = '';
}

function countMarge() {
    // Parse values as floats
    const price = parseFloat(productForm.price);
    const marge = parseFloat(productForm.marge);
    const sellPrice = parseFloat(productForm.Sprice);

    // Debug log
    console.log("price:", price, "marge:", marge, "sellPrice:", sellPrice);

    // If price is invalid, reset both
    if (isNaN(price) || price <= 0) {
        productForm.Sprice = '';
        productForm.marge = '';
        return;
    }

    // If price and marge are valid, but sellPrice is not, calculate sellPrice
    if (!isNaN(marge) && (isNaN(sellPrice) || document.activeElement.id === 'product-marge')) {
        const calculatedSellPrice = price * (1 + marge / 100);
        productForm.Sprice = isFinite(calculatedSellPrice) ? calculatedSellPrice.toFixed(2) : '';
        return;
    }

    // If price and sellPrice are valid, but marge is not, calculate marge
    if (!isNaN(sellPrice) && (isNaN(marge) || document.activeElement.id === 'product-SellPrice')) {
        const calculatedMargin = ((sellPrice - price) / price) * 100;
        productForm.marge = isFinite(calculatedMargin) ? calculatedMargin.toFixed(2) : '';
        return;
    }
}

// import files
const file = ref(null)

const handleFile = (e) => {
    file.value = e.target.files[0]
}


// Add these to your existing reactive variables
const showImportSection = ref(false);
const importing = ref(false);

// Add these functions
function toggleImportSection() {
    showImportSection.value = !showImportSection.value;
}

function clearFile() {
    file.value = null;
}

// Update your existing importProducts function
const importProducts = async () => {
    if (!file.value) return alert("Please select a file.");
    
    importing.value = true;
    const formData = new FormData();
    formData.append('excel_file', file.value);

    try {
        const response = await fetch('/api/import-products', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: formData,
        });

        const data = await response.json();
        if (response.ok) {
            file.value = null;
            showImportSection.value = false;
            await fetchProducts(); // Refresh the products list
        } else {
            alert('Failed to import: ' + (data.message || 'Unknown error'));
        }
    } catch (err) {
        alert('Error: ' + err.message);
    } finally {
        importing.value = false;
    }
}

// Initialize
onMounted(() => {
    fetchProducts();
    fetchCategories();
});
</script>