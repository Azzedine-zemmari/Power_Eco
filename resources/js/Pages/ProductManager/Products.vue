<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <div class="flex h-screen overflow-hidden">
            <Sidebar />

            <!-- Main content -->
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <!-- Top header -->
                <div class="flex-shrink-0 flex h-16 bg-white shadow">
                    <div class="flex-1 px-4 sm:px-6 flex gap-2 items-center">
                        <div class="flex items-center">
                            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">Products</h1>
                        </div>
                        <!-- Add refresh button -->
                        <button 
                            @click="fetchProducts"
                            :disabled="loading"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50"
                        >
                            <svg :class="loading ? 'animate-spin' : ''" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            {{ loading ? 'Refreshing...' : 'Refresh' }}
                        </button>
                    </div>
                </div>

                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-4 sm:py-6">
                        <!-- Header Section -->
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-between sm:items-center sm:space-y-0">
                                <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">All Products</h1>
                                <div class="flex flex-col space-y-3 sm:flex-row sm:space-y-0 sm:space-x-3">
                                    <!-- Import Products Button -->
                                    <button @click="toggleImportSection" type="button"
                                        class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        Import Products
                                    </button>
                                    
                                    <!-- Add New Product Button -->
                                    <button @click="openModal" type="button" id="create-product-btn"
                                        class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                        Add New Product
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Success/Error Messages -->
                        <div v-if="successMessage" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                            <div class="bg-green-50 border border-green-200 rounded-md p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-green-800">{{ successMessage }}</p>
                                    </div>
                                    <div class="ml-auto pl-3">
                                        <button @click="successMessage = ''" class="inline-flex text-green-400 hover:text-green-500">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Import Products Section (Collapsible) -->
                        <div v-if="showImportSection" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                            <div class="bg-white shadow rounded-lg border border-gray-200">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 space-y-2 sm:space-y-0">
                                        <div class="flex-1">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900">Import Products from Excel</h3>
                                            <p class="mt-1 text-sm text-gray-500">
                                                Upload an Excel file (.xlsx, .xls) or CSV file to import multiple products at once.
                                            </p>
                                        </div>
                                        <button @click="showImportSection = false" type="button"
                                            class="flex-shrink-0 text-gray-400 hover:text-gray-500 p-1">
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
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6 px-4 text-center">
                                                    <svg v-if="!file" class="w-8 h-8 mb-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                    </svg>
                                                    <svg v-else class="w-8 h-8 mb-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <p v-if="!file" class="mb-2 text-sm text-gray-500">
                                                        <span class="font-semibold">Click to upload</span> or drag and drop
                                                    </p>
                                                    <p v-else class="mb-2 text-sm text-green-600 font-semibold break-all">
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
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                                            <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                                                <button v-if="file" @click="clearFile" type="button"
                                                    class="w-full sm:w-auto inline-flex justify-center items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                    <svg class="-ml-0.5 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Clear File
                                                </button>
                                                
                                                <a href="#" class="text-sm text-green-600 hover:text-green-500 font-medium text-center sm:text-left">
                                                    Download Sample Template
                                                </a>
                                            </div>

                                            <button type="submit" :disabled="!file || importing"
                                                class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed">
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
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m-1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
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

                        <!-- Main Content -->
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="py-4">
                                <!-- Search and filter -->
                                <div class="pb-5 border-b border-gray-200">
                                    <!-- Search Bar -->
                                    <div class="mb-4">
                                        <div class="relative max-w-md">
                                            <input type="text" name="search" id="search" v-model="searchQuery"
                                                class="focus:ring-green-500 focus:border-green-500 block w-full rounded-md pl-10 sm:text-sm border-gray-300"
                                                placeholder="Search products">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Filters -->
                                    <div class="space-y-4 sm:space-y-0">
                                        <!-- Category Filter -->
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-3 sm:space-y-0">
                                            <div class="w-full sm:w-auto">
                                                <label class="block text-sm font-medium text-gray-700 mb-1 sm:sr-only">Category</label>
                                                <select v-model="selectedCategoryFilter"
                                                    class="block w-full sm:w-48 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                                    <option value="" selected disabled>All Categories</option>
                                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                                        {{ category.name }}
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- Price Range -->
                                            <div class="flex items-center space-x-2 w-full sm:w-auto">
                                                <label class="block text-sm font-medium text-gray-700 sm:sr-only">Price Range</label>
                                                <input v-model="minPriceFilter" type="number" step="0.01" placeholder="Min Price"
                                                    class="block w-full sm:w-24 pl-3 pr-2 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md" />
                                                <span class="text-gray-500 hidden sm:inline">-</span>
                                                <input v-model="maxPriceFilter" type="number" step="0.01" placeholder="Max Price"
                                                    class="block w-full sm:w-24 pl-3 pr-2 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md" />
                                            </div>

                                            <!-- Stock Range -->
                                            <div class="flex items-center space-x-2 w-full sm:w-auto">
                                                <label class="block text-sm font-medium text-gray-700 sm:sr-only">Stock Range</label>
                                                <input v-model="minStockFilter" type="number" step="1" placeholder="Min Stock"
                                                    class="block w-full sm:w-24 pl-3 pr-2 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md" />
                                                <span class="text-gray-500 hidden sm:inline">-</span>
                                                <input v-model="maxStockFilter" type="number" step="1" placeholder="Max Stock"
                                                    class="block w-full sm:w-24 pl-3 pr-2 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md" />
                                            </div>

                                            <!-- Clear Filters Button -->
                                            <button v-if="hasActiveFilters" 
                                                @click="resetFilters"
                                                class="w-full sm:w-auto inline-flex justify-center items-center px-3 py-2 border border-transparent text-xs leading-4 font-medium rounded text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <svg class="mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                                Clear filters
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Products list -->
                                <div class="mt-8">
                                    <div v-if="loading" class="text-center py-10">
                                        <svg class="animate-spin h-10 w-10 text-green-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <p class="mt-2 text-gray-600">Loading products...</p>
                                    </div>
                                    
                                    <div v-else-if="error" class="bg-red-50 p-4 rounded-md">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-red-800">{{ error }}</h3>
                                                <div class="mt-4">
                                                    <button @click="fetchProducts" class="bg-red-100 px-3 py-2 rounded-md text-sm font-medium text-red-800 hover:bg-red-200">
                                                        Retry
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div v-else>
                                        <!-- Grid view for products -->
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                                            <!-- Product card -->
                                            <div v-for="product in filteredProducts" :key="product.id"
                                                class="bg-white overflow-hidden shadow rounded-lg hover:shadow-lg transition-shadow duration-200">
                                                <div class="aspect-w-3 aspect-h-2">
                                                    <img 
                                                        class="object-cover w-full h-48" 
                                                        :src="getImageUrl(product.image)" 
                                                        :alt="product.name"
                                                        @error="handleImageError"
                                                    >
                                                </div>
                                                <div class="p-4">
                                                    <div class="flex items-center gap-1">
                                                        <h3
                                                        class="text-lg leading-6 font-medium text-gray-900 truncate"
                                                        :class="{ 'line-through text-gray-400': product.status === 'inactive' }"
                                                        >
                                                        {{ product.name }}
                                                    </h3>                                       
                                                    <span v-if="product.status === 'inactive'" class="ml-1 text-xs text-red-500">(inactive)</span>
                                                    </div>
                                                <div class="mt-2">
                                                        <p class="text-sm text-gray-500 line-clamp-2">{{ product.description }}</p>
                                                    </div>
                                                    <div class="mt-3 flex items-center justify-between">
                                                        <div class="flex items-center space-x-2">
                                                            <span class="text-xl font-bold text-gray-900">{{ formatPrice(product.sell_price) }} DH</span>
                                                            <span class="text-sm text-gray-500 ">
                                                                {{ formatPrice(product.price) }} DH
                                                                <span class="ml-1" title="Price before margin/benefit">(cost)</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3 flex flex-wrap gap-2">
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            {{ getCategoryName(product.categorie_id) }}
                                                        </span>
                                                        <span v-if="product.stock > 0" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                            Stock: {{ product.stock }}
                                                        </span>
                                                        <span v-else class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                            Out of Stock
                                                        </span>
                                                        <span v-if="product.marge" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                            Margin: {{ product.marge }}%
                                                        </span>
                                                    </div>
                                                    <div class="mt-4 flex flex-col sm:flex-row gap-2">
                                                        <button @click="editProduct(product)"
                                                            :disabled="submitting"
                                                            class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50">
                                                            <svg class="-ml-0.5 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                            </svg>
                                                            Edit
                                                        </button>
                                                        <!-- <button @click="confirmDelete(product)"
                                                            :disabled="submitting"
                                                            class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 disabled:opacity-50">
                                                            <svg class="-ml-0.5 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                            </svg>
                                                            Delete
                                                        </button> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Empty state -->
                                        <div v-if="products.length === 0" class="text-center py-12">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <h3 class="mt-2 text-sm font-medium text-gray-900">No products</h3>
                                            <p class="mt-1 text-sm text-gray-500">Get started by creating a new product.</p>
                                            <div class="mt-6">
                                                <button @click="openModal" type="button"
                                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
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
        <div v-if="isModalOpen" class="fixed z-50 inset-0 overflow-y-auto" id="product-modal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="closeModal"></div>

                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
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
                                            <label for="product-name" class="block text-sm font-medium text-gray-700">
                                                Product Name <span class="text-red-500">*</span>
                                            </label>
                                            <div class="mt-1">
                                                <input 
                                                    v-model="productForm.name" 
                                                    type="text" 
                                                    id="product-name" 
                                                    name="product-name" 
                                                    required
                                                    :disabled="submitting"
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md disabled:opacity-50"
                                                    :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.name }">
                                                <div v-if="errors.name" class="text-red-500 text-sm mt-1">
                                                    {{ Array.isArray(errors.name) ? errors.name[0] : errors.name }}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product Description -->
                                        <div>
                                            <label for="product-description" class="block text-sm font-medium text-gray-700">Description</label>
                                            <div class="mt-1">
                                                <textarea 
                                                    v-model="productForm.description" 
                                                    id="product-description" 
                                                    name="product-description" 
                                                    rows="3"
                                                    :disabled="submitting"
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md disabled:opacity-50"
                                                    :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.description }"></textarea>
                                                <div v-if="errors.description" class="text-red-500 text-sm mt-1">
                                                    {{ Array.isArray(errors.description) ? errors.description[0] : errors.description }}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Price and Stock -->
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label for="product-price" class="block text-sm font-medium text-gray-700">
                                                    Price (DH) <span class="text-red-500">*</span>
                                                </label>
                                                <div class="mt-1">
                                                    <input 
                                                        v-model="productForm.price" 
                                                        @input="countMarge" 
                                                        type="number" 
                                                        step="0.01" 
                                                        id="product-price" 
                                                        name="product-price" 
                                                        required
                                                        :disabled="submitting"
                                                        class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md disabled:opacity-50"
                                                        :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.price }">
                                                    <div v-if="errors.price" class="text-red-500 text-sm mt-1">
                                                        {{ Array.isArray(errors.price) ? errors.price[0] : errors.price }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="product-stock" class="block text-sm font-medium text-gray-700">
                                                    Stock <span class="text-red-500">*</span>
                                                </label>
                                                <div class="mt-1">
                                                    <input 
                                                        v-model="productForm.stock" 
                                                        type="number" 
                                                        id="product-stock" 
                                                        name="product-stock" 
                                                        required
                                                        :disabled="submitting"
                                                        class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md disabled:opacity-50"
                                                        :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.stock }">
                                                    <div v-if="errors.stock" class="text-red-500 text-sm mt-1">
                                                        {{ Array.isArray(errors.stock) ? errors.stock[0] : errors.stock }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Margin & Sell Price -->
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label for="product-marge" class="block text-sm font-medium text-gray-700">Margin (%)</label>
                                                <div class="mt-1">
                                                    <input 
                                                        v-model="productForm.marge" 
                                                        @input="countMarge" 
                                                        type="number" 
                                                        step="0.01"
                                                        id="product-marge" 
                                                        name="product-marge"
                                                        :disabled="submitting"
                                                        class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md disabled:opacity-50"
                                                        :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.marge }">
                                                    <div v-if="errors.marge" class="text-red-500 text-sm mt-1">
                                                        {{ Array.isArray(errors.marge) ? errors.marge[0] : errors.marge }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="product-SellPrice" class="block text-sm font-medium text-gray-700">Sell Price (DH)</label>
                                                <div class="mt-1">
                                                    <input 
                                                        v-model="productForm.Sprice" 
                                                        @input="countMarge" 
                                                        type="number" 
                                                        step="0.01"
                                                        id="product-SellPrice" 
                                                        name="product-SellPrice"
                                                        :disabled="submitting"
                                                        class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md disabled:opacity-50"
                                                        :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.Sprice }">
                                                    <div v-if="errors.Sprice" class="text-red-500 text-sm mt-1">
                                                        {{ Array.isArray(errors.Sprice) ? errors.Sprice[0] : errors.Sprice }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Category -->
                                        <div>
                                            <label for="product-category" class="block text-sm font-medium text-gray-700">
                                                Category <span class="text-red-500">*</span>
                                            </label>
                                            <div class="mt-1">
                                                <select 
                                                    v-model="productForm.categorie_id" 
                                                    id="product-category" 
                                                    name="product-category" 
                                                    required
                                                    :disabled="submitting"
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md disabled:opacity-50"
                                                    :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.categorie_id }">
                                                    <option value="">Select a category</option>
                                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                                        {{ category.name }}
                                                    </option>
                                                </select>
                                                <div v-if="errors.categorie_id" class="text-red-500 text-sm mt-1">
                                                    {{ Array.isArray(errors.categorie_id) ? errors.categorie_id[0] : errors.categorie_id }}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product Image -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Product Image</label>
                                            <div class="mt-1 flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-4">
                                                <div class="flex-shrink-0 h-16 w-16 bg-gray-100 rounded-md overflow-hidden">
                                                    <img 
                                                        v-if="getPreviewImage()" 
                                                        :src="getPreviewImage()" 
                                                        alt="Product preview" 
                                                        class="h-full w-full object-cover"
                                                        @error="handleImageError"
                                                    >
                                                    <div v-else class="h-full w-full flex items-center justify-center">
                                                        <svg class="h-8 w-8 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                        </svg>
                                                    </div>
                                                </div>

                                                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                                                    <div class="relative bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm flex items-center cursor-pointer hover:bg-gray-50 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                                        <label for="product-image" class="relative text-sm font-medium text-gray-700 pointer-events-none">
                                                            <span>{{ productForm.imagePreview || productForm.image ? 'Change' : 'Upload' }}</span>
                                                            <span class="sr-only"> product image</span>
                                                        </label>
                                                        <input 
                                                            id="product-image" 
                                                            name="image" 
                                                            type="file"
                                                            accept="image/*"
                                                            :disabled="submitting"
                                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer border-gray-300 rounded-md disabled:cursor-not-allowed"
                                                            @change="handleImageChange">
                                                    </div>
                                                    <button 
                                                        v-if="productForm.imagePreview || productForm.image" 
                                                        type="button"
                                                        :disabled="submitting"
                                                        class="bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50"
                                                        @click="removeImage">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                            <div v-if="errors.image" class="text-red-500 text-sm mt-1">
                                                {{ Array.isArray(errors.image) ? errors.image[0] : errors.image }}
                                            </div>
                                        </div>

                                        <!-- Status -->
                                        <div>
                                            <label for="product-status" class="block text-sm font-medium text-gray-700">Status</label>
                                            <div class="mt-1">
                                                <select 
                                                    v-model="productForm.status" 
                                                    id="product-status" 
                                                    name="product-status"
                                                    :disabled="submitting"
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md disabled:opacity-50">
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                                <div v-if="errors.status" class="text-red-500 text-sm mt-1">
                                                    {{ Array.isArray(errors.status) ? errors.status[0] : errors.status }}
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 flex flex-col-reverse sm:flex-row sm:justify-end space-y-3 space-y-reverse sm:space-y-0 sm:space-x-3">
                        <button 
                            type="button" 
                            @click="closeModal" 
                            id="cancel-product-btn"
                            :disabled="submitting"
                            class="w-full sm:w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm disabled:opacity-50">
                            Cancel
                        </button>
                        <button 
                            type="button" 
                            @click="submitProduct" 
                            id="save-product-btn"
                            :disabled="submitting"
                            class="w-full sm:w-auto inline-flex justify-center items-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm disabled:opacity-50">
                            <svg v-if="submitting" class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ submitting ? (isEditing ? 'Updating...' : 'Creating...') : (isEditing ? 'Update Product' : 'Save Product') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <!-- <div v-if="isDeleteModalOpen" class="fixed z-50 inset-0 overflow-y-auto" id="delete-confirmation-modal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"> -->
                <!-- Background overlay -->
                <!-- <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="closeDeleteModal"></div> -->

                <!-- Modal panel -->
                <!-- <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Product</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Are you sure you want to delete "<strong>{{ selectedProduct?.name }}</strong>"? This action cannot be undone.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 flex flex-col-reverse sm:flex-row sm:justify-end space-y-3 space-y-reverse sm:space-y-0 sm:space-x-3">
                        <button 
                            type="button" 
                            @click="closeDeleteModal" 
                            id="cancel-delete-btn"
                            :disabled="submitting"
                            class="w-full sm:w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm disabled:opacity-50">
                            Cancel
                        </button>
                        <button 
                            type="button" 
                            @click="deleteProduct" 
                            id="confirm-delete-btn"
                            :disabled="submitting"
                            class="w-full sm:w-auto inline-flex justify-center items-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm disabled:opacity-50">
                            <svg v-if="submitting" class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ submitting ? 'Deleting...' : 'Delete Product' }}
                        </button>
                    </div>
                </div> -->
            <!-- </div>
        </div>
    -->
    </div>
</template>

<script setup>
import { ref, onMounted, reactive, computed } from 'vue';
import axios from 'axios';
import Sidebar from '../../components/Sidebar.vue';

// State variables
const isModalOpen = ref(false);
const isDeleteModalOpen = ref(false);
const isEditing = ref(false);
const loading = ref(true);
const submitting = ref(false);
const error = ref(null);
const successMessage = ref('');
const products = ref([]);
const categories = ref([]);
const selectedProduct = ref(null);
const errors = ref({});

// Filter states
const selectedCategoryFilter = ref('');
const minPriceFilter = ref('');
const maxPriceFilter = ref('');
const minStockFilter = ref('');
const maxStockFilter = ref('');
const searchQuery = ref('');

// Import states
const showImportSection = ref(false);
const importing = ref(false);
const file = ref(null);

// API configuration
const API_BASE_URL = 'http://localhost:8000';
const token = localStorage.getItem('token');

// Form state
const productForm = reactive({
    id: null,
    name: '',
    description: '',
    price: '',
    stock: '',
    marge: '',
    Sprice: '',
    categorie_id: '',
    image: null,
    imagePreview: null,
    imageFile: null,
    status: 'active'
});

// Utility functions
function formatPrice(price) {
    const numPrice = parseFloat(price) || 0;
    return new Intl.NumberFormat('fr-FR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(numPrice);
}

function getCategoryName(categoryId) {
    const category = categories.value.find(cat => cat.id == categoryId);
    return category ? category.name : 'Non catégorisé';
}

function getImageUrl(imagePath) {
    if (!imagePath) return '/placeholder.svg?height=200&width=200';
    
    if (imagePath.startsWith('http') || imagePath.startsWith('blob:')) {
        return imagePath;
    }
    
    if (imagePath.startsWith('storage/')) {
        return `${API_BASE_URL}/${imagePath}`;
    }
    
    return `${API_BASE_URL}/storage/${imagePath}`;
}

function getPreviewImage() {
    if (productForm.imagePreview) {
        return productForm.imagePreview;
    }
    if (productForm.image) {
        return getImageUrl(productForm.image);
    }
    return null;
}

function handleImageError(event) {
    event.target.src = '/placeholder.svg?height=200&width=200';
}

function showSuccess(message) {
    successMessage.value = message;
    setTimeout(() => {
        successMessage.value = '';
    }, 5000);
}

// Modal functions
function openModal() {
    isModalOpen.value = true;
    isEditing.value = false;
    resetForm();
    errors.value = {};
}

function closeModal() {
    isModalOpen.value = false;
    errors.value = {};
    resetForm();
}

function editProduct(product) {
    console.log('🔧 Editing product:', product);
    isEditing.value = true;
    
    console.log('🔧 Editing product:', product);
    isEditing.value = true;
    
    // Populate form with product data
    productForm.id = product.id;
    productForm.name = product.name || '';
    productForm.description = product.description || '';
    productForm.price = parseFloat(product.price) || '';
    productForm.stock = parseInt(product.stock) || '';
    productForm.marge = product.marge ? parseFloat(product.marge) : '';
    productForm.Sprice = product.sell_price ? parseFloat(product.sell_price) : '';
    productForm.categorie_id = product.categorie_id ? String(product.categorie_id) : '';
    productForm.status = product.status || 'active';

    // Handle existing image
    if (product.image) {
        productForm.image = product.image;
        productForm.imagePreview = null; // Will use getPreviewImage() to show existing image
        productForm.imageFile = null;
    } else {
        productForm.image = null;
        productForm.imagePreview = null;
        productForm.imageFile = null;
    }

    isModalOpen.value = true;
    errors.value = {};
}

function resetForm() {
    productForm.id = null;
    productForm.name = '';
    productForm.description = '';
    productForm.price = '';
    productForm.stock = '';
    productForm.marge = '';
    productForm.Sprice = '';
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
        productForm.imageFile = file;
        productForm.imagePreview = URL.createObjectURL(file);
        // Clear existing image reference when new file is selected
        productForm.image = null;
    }
}

function removeImage() {
    productForm.imageFile = null;
    productForm.imagePreview = null;
    productForm.image = null;
}

function countMarge() {
    const price = parseFloat(productForm.price);
    const marge = parseFloat(productForm.marge);
    const sellPrice = parseFloat(productForm.Sprice);

    if (isNaN(price) || price <= 0) {
        productForm.Sprice = '';
        productForm.marge = '';
        return;
    }

    if (!isNaN(marge) && (isNaN(sellPrice) || document.activeElement?.id === 'product-marge')) {
        const calculatedSellPrice = price * (1 + marge / 100);
        productForm.Sprice = isFinite(calculatedSellPrice) ? calculatedSellPrice.toFixed(2) : '';
        return;
    }

    if (!isNaN(sellPrice) && (isNaN(marge) || document.activeElement?.id === 'product-SellPrice')) {
        const calculatedMargin = ((sellPrice - price) / price) * 100;
        productForm.marge = isFinite(calculatedMargin) ? calculatedMargin.toFixed(2) : '';
        return;
    }
}

// API functions with improved error handling
async function fetchProducts() {
    console.log('🔄 Starting fetchProducts...');
    loading.value = true;
    error.value = null;

    try {
        if (!token) {
            throw new Error('Authentication token missing');
        }

        console.log('📡 Making API request to fetch products...');
        const response = await axios.get(`${API_BASE_URL}/api/product-manager/products`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        console.log('📡 Response status:', response.status);
        console.log('✅ Raw API response:', response.data);

        // Handle different response structures
        let productsData;
        if (response.data.products) {
            productsData = response.data.products;
        } else if (response.data.data) {
            productsData = response.data.data;
        } else if (Array.isArray(response.data)) {
            productsData = response.data;
        } else {
            productsData = [];
        }

        console.log('✅ Processed products data:', productsData);
        products.value = productsData;
    } catch (err) {
        console.error('❌ Error in fetchProducts:', err);
        if (err.response?.status === 401) {
            error.value = 'Session expired. Please log in again.';
        } else {
            error.value = 'Failed to load products.';
        }
    } finally {
        loading.value = false;
        console.log('🏁 fetchProducts completed');
    }
}

async function fetchCategories() {
    try {
        if (!token) {
            throw new Error('Authentication token missing');
        }

        const response = await axios.get(`${API_BASE_URL}/api/categories`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        // Handle different response structures
        let categoriesData;
        if (response.data.categories) {
            categoriesData = response.data.categories;
        } else if (response.data.data) {
            categoriesData = response.data.data;
        } else if (Array.isArray(response.data)) {
            categoriesData = response.data;
        } else {
            categoriesData = [];
        }

        categories.value = categoriesData;
    } catch (err) {
        console.error('Error fetching categories:', err);
    }
}

async function submitProduct() {
    if (submitting.value) return;
    
    console.log('🚀 Starting product submission...');
    console.log('📝 Form data:', productForm);
    
    submitting.value = true;
    errors.value = {};

    try {
        if (!token) {
            throw new Error('Authentication token missing');
        }

        const formData = new FormData();
        
        // Ensure all required fields are properly set
        formData.append('name', String(productForm.name).trim());
        formData.append('description', String(productForm.description || '').trim());
        formData.append('price', String(productForm.price));
        formData.append('stock', String(productForm.stock));
        formData.append('categorie_id', String(productForm.categorie_id));
        formData.append('status', String(productForm.status));

        // Optional fields
        if (productForm.marge !== '' && productForm.marge !== null && productForm.marge !== undefined) {
            formData.append('marge', String(productForm.marge));
        }
        if (productForm.Sprice !== '' && productForm.Sprice !== null && productForm.Sprice !== undefined) {
            formData.append('sell_price', String(productForm.Sprice));
        }

        // Only append image if there's a new file selected
        if (productForm.imageFile) {
            formData.append('image', productForm.imageFile);
        }

        let url, method;
        if (isEditing.value) {
            url = `${API_BASE_URL}/api/products/${productForm.id}/update`;
            method = 'post'; // Using POST with _method override for file uploads
            formData.append('_method', 'PUT');
        } else {
            url = `${API_BASE_URL}/api/products/create`;
            method = 'post';
        }

        console.log('📡 Sending request to:', url);
        console.log('📡 Method:', method);

        const response = await axios[method](url, formData, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
                'Content-Type': 'multipart/form-data'
            }
        });

        console.log('📡 Response status:', response.status);
        console.log('✅ Product submitted successfully:', response.data);

        // Close modal and show success message
        closeModal();
        showSuccess(isEditing.value ? 'Product updated successfully!' : 'Product created successfully!');
        
        // Refresh products list
        setTimeout(async () => {
            await fetchProducts();
        }, 300);

    } catch (err) {
        console.error('❌ Error submitting product:', err);
        
        if (err.response) {
            console.log('❌ Error response:', err.response.data);
            if (err.response.status === 422) {
                errors.value = err.response.data.errors || {};
                console.log('❌ Validation errors:', errors.value);
            } else if (err.response.status === 401) {
                error.value = 'Session expired. Please log in again.';
            } else if (err.response.status === 403) {
                error.value = 'Access denied. You must be a product manager.';
            } else if (err.response.status === 404 && isEditing.value) {
                error.value = 'Product not found.';
            } else {
                error.value = err.response.data?.message || 'Error submitting product.';
            }
        } else {
            error.value = 'Network error. Please try again.';
        }
    } finally {
        submitting.value = false;
    }
}
async function deleteProduct() {
    if (submitting.value || !selectedProduct.value) return;
    submitting.value = true;
    try {
        await axios.post(`${API_BASE_URL}/api/products/${selectedProduct.value.id}/delete`, {}, {
            headers: { 'Authorization': `Bearer ${token}` }
        });
        // Remove from local list immediately
        products.value = products.value.filter(p => p.id !== selectedProduct.value.id);
        closeDeleteModal();
        showSuccess('Product deleted successfully!');
        // Optionally refresh from server
        // Avoid calling fetchProducts here if it causes a loop
        fetchProducts();
    } catch (err) {
        error.value = 'Network error. Please try again.';
    } finally {
        submitting.value = false;
    }
}

// Filter functions
const filteredProducts = computed(() => {
    let filtered = products.value;

    // Search filter
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        filtered = filtered.filter(product => 
            product.name.toLowerCase().includes(query) ||
            (product.description && product.description.toLowerCase().includes(query))
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

    // Stock filter
    const minStock = parseInt(minStockFilter.value);
    const maxStock = parseInt(maxStockFilter.value);
    if (!isNaN(minStock)) {
        filtered = filtered.filter(product => parseInt(product.stock) >= minStock);
    }
    if (!isNaN(maxStock)) {
        filtered = filtered.filter(product => parseInt(product.stock) <= maxStock);
    }

    return filtered;
});

const hasActiveFilters = computed(() => {
    return selectedCategoryFilter.value !== '' ||
           minPriceFilter.value !== '' ||
           maxPriceFilter.value !== '' ||
           minStockFilter.value !== '' ||
           maxStockFilter.value !== '' ||
           searchQuery.value !== '';
});

function resetFilters() {
    selectedCategoryFilter.value = '';
    minPriceFilter.value = '';
    maxPriceFilter.value = '';
    minStockFilter.value = '';
    maxStockFilter.value = '';
    searchQuery.value = '';
}

// Import functions
function toggleImportSection() {
    showImportSection.value = !showImportSection.value;
}

function handleFile(e) {
    file.value = e.target.files[0];
}

function clearFile() {
    file.value = null;
}

const importProducts = async () => {
    if (!file.value) {
        alert("Please select a file.");
        return;
    }
    
    importing.value = true;
    const formData = new FormData();
    formData.append('excel_file', file.value);

    try {
        const response = await axios.post(`${API_BASE_URL}/api/import-products`, formData, {
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'multipart/form-data'
            }
        });

        if (response.data.success || response.status === 200) {
            file.value = null;
            showImportSection.value = false;
            await fetchProducts();
            showSuccess('Products imported successfully!');
        } else {
            alert('Failed to import: ' + (response.data.message || 'Unknown error'));
        }
    } catch (err) {
        console.error('Import error:', err);
        if (err.response?.status === 403) {
            alert('Access denied. You must be a product manager.');
        } else {
            alert('Error: ' + (err.response?.data?.message || err.message));
        }
    } finally {
        importing.value = false;
    }
};

// Initialize
onMounted(() => {
    fetchProducts();
    fetchCategories();
});
</script>
