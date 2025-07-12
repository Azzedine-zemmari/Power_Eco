<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <Sidebar/>

            <!-- Main content -->
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <!-- Top header -->
                <div class="flex-shrink-0 flex h-16 bg-white shadow">
                    <div class="flex-1 px-4 flex justify-between items-center">
                        <div class="flex items-center">
                            <h1 class="text-2xl font-semibold text-gray-900">Categories</h1>
                        </div>
                        <!-- Refresh button -->
                        <button 
                            @click="fetchCategories"
                            :disabled="loading"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <svg :class="loading ? 'animate-spin' : ''" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            {{ loading ? 'Actualisation...' : 'Actualiser' }}
                        </button>
                    </div>
                </div>

                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <div class="flex justify-between items-center">
                                <h1 class="text-2xl font-semibold text-gray-900">All Categories</h1>
                                <button @click="openModal" type="button" id="create-category-btn"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Create Category
                                </button>
                            </div>
                        </div>
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <!-- Categories content -->
                            <div class="py-4">
                                <!-- Search and filter -->
                                <div class="pb-5 border-b border-gray-200 sm:flex sm:items-center sm:justify-between">
                                    <div class="mt-3 sm:mt-0 sm:ml-4">
                                        <label for="search" class="sr-only">Search categories</label>
                                        <div class="flex rounded-md shadow-sm">
                                            <div class="relative flex-grow focus-within:z-10">
                                                <input 
                                                    type="text" 
                                                    v-model="searchTerm"
                                                    @input="filterCategories"
                                                    name="search" 
                                                    id="search"
                                                    class="focus:ring-green-500 focus:border-green-500 block w-full rounded-md pl-10 sm:text-sm border-gray-300"
                                                    placeholder="Search categories">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Loading State -->
                                <div v-if="loading" class="mt-8 flex justify-center items-center py-12">
                                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-green-500"></div>
                                    <span class="ml-3 text-gray-600">Chargement des catégories...</span>
                                </div>

                                <!-- Error State -->
                                <div v-else-if="error" class="mt-8 bg-red-50 border border-red-200 rounded-md p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-red-800">Erreur de chargement</h3>
                                            <div class="mt-2 text-sm text-red-700">
                                                <p>{{ error }}</p>
                                            </div>
                                            <div class="mt-4">
                                                <button @click="fetchCategories" class="bg-red-100 px-3 py-2 rounded-md text-sm font-medium text-red-800 hover:bg-red-200">
                                                    Réessayer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Empty State -->
                                <div v-else-if="!loading && filteredCategories.length === 0 && categories.length === 0" class="mt-8 bg-white shadow rounded-lg">
                                    <div class="text-center py-12">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune catégorie</h3>
                                        <p class="mt-1 text-sm text-gray-500">Commencez par créer votre première catégorie.</p>
                                        <div class="mt-6">
                                            <button @click="openModal" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                                <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                                </svg>
                                                Créer une catégorie
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- No Search Results -->
                                <div v-else-if="!loading && filteredCategories.length === 0 && searchTerm" class="mt-8 bg-white shadow rounded-lg">
                                    <div class="text-center py-12">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun résultat</h3>
                                        <p class="mt-1 text-sm text-gray-500">Aucune catégorie ne correspond à "{{ searchTerm }}".</p>
                                        <div class="mt-6">
                                            <button @click="clearSearch" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                                Effacer la recherche
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Categories list -->
                                <div v-else class="mt-8 bg-white shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                            {{ filteredCategories.length }} catégorie(s)
                                            <span v-if="searchTerm" class="text-sm font-normal text-gray-500">
                                                pour "{{ searchTerm }}"
                                            </span>
                                        </h3>
                                    </div>
                                    <ul class="divide-y divide-gray-200">
                                        <li v-for="category in filteredCategories" :key="category.id" class="hover:bg-gray-50 transition-colors duration-150">
                                            <div class="px-4 py-4 flex items-center sm:px-6">
                                                <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                                    <div>
                                                        <div class="flex text-sm">
                                                            <p class="font-medium text-green-600 truncate">
                                                                {{ category.name }}
                                                            </p>
                                                        </div>
                                                        <div v-if="category.description" class="mt-2 flex">
                                                            <div class="flex items-center text-sm text-gray-500">
                                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor">
                                                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                {{ category.description }}
                                                            </div>
                                                        </div>
                                                        <div class="mt-2 flex items-center text-xs text-gray-400">
                                                            <span>ID: {{ category.id }}</span>
                                                            <span v-if="category.created_at" class="ml-4">
                                                                Créé le {{ formatDate(category.created_at) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4 flex-shrink-0 sm:mt-0">
                                                        <div class="flex space-x-4">
                                                            <button 
                                                                @click="openEditModal(category)" 
                                                                type="button"
                                                                :disabled="submitting"
                                                                class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                </svg>
                                                                Edit
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!-- Create Category Modal -->
        <div v-if="isOpen" class="fixed z-10 inset-0 overflow-y-auto" id="create-category-modal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="closeModal"></div>

                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Create New Category</h3>
                                <div class="mt-4">
                                    <form @submit.prevent="submitCategory" class="space-y-6">
                                        <div>
                                            <label for="category-name" class="block text-sm font-medium text-gray-700">
                                                Category Name <span class="text-red-500">*</span>
                                            </label>
                                            <div class="mt-1">
                                                <input 
                                                    v-model="name" 
                                                    type="text" 
                                                    id="category-name" 
                                                    name="category-name" 
                                                    required
                                                    :disabled="submitting"
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md disabled:opacity-50 disabled:cursor-not-allowed"
                                                    :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.name }">
                                                <div v-if="errors.name" class="mt-1 text-red-500 text-sm">
                                                    {{ Array.isArray(errors.name) ? errors.name[0] : errors.name }}
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="category-description" class="block text-sm font-medium text-gray-700">Description</label>
                                            <div class="mt-1">
                                                <textarea 
                                                    v-model="description" 
                                                    id="category-description" 
                                                    name="category-description" 
                                                    rows="3"
                                                    :disabled="submitting"
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md disabled:opacity-50 disabled:cursor-not-allowed"
                                                    :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.description }"></textarea>
                                                <div v-if="errors.description" class="mt-1 text-red-500 text-sm">
                                                    {{ Array.isArray(errors.description) ? errors.description[0] : errors.description }}
                                                </div>
                                            </div>
                                            <p class="mt-2 text-sm text-gray-500">Brief description of the category.</p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button 
                            @click="submitCategory" 
                            type="button"
                            :disabled="submitting || !name.trim()"
                            class="w-full inline-flex justify-center items-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg v-if="submitting" class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ submitting ? 'Création...' : 'Save Category' }}
                        </button>
                        <button 
                            @click="closeModal" 
                            type="button"
                            :disabled="submitting"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Category Modal -->
        <div v-if="isEditOpen" class="fixed z-10 inset-0 overflow-y-auto" id="edit-category-modal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="closeEditModal"></div>

                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Category</h3>
                                <div class="mt-4">
                                    <form @submit.prevent="updateCategory" class="space-y-6">
                                        <div>
                                            <label for="edit-category-name" class="block text-sm font-medium text-gray-700">
                                                Category Name <span class="text-red-500">*</span>
                                            </label>
                                            <div class="mt-1">
                                                <input 
                                                    v-model="name" 
                                                    type="text" 
                                                    id="edit-category-name" 
                                                    name="edit-category-name"
                                                    required
                                                    :disabled="submitting"
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md disabled:opacity-50 disabled:cursor-not-allowed"
                                                    :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.name }">
                                                <div v-if="errors.name" class="mt-1 text-red-500 text-sm">
                                                    {{ Array.isArray(errors.name) ? errors.name[0] : errors.name }}
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="edit-category-description" class="block text-sm font-medium text-gray-700">Description</label>
                                            <div class="mt-1">
                                                <textarea 
                                                    v-model="description" 
                                                    id="edit-category-description"
                                                    name="edit-category-description" 
                                                    rows="3"
                                                    :disabled="submitting"
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md disabled:opacity-50 disabled:cursor-not-allowed"
                                                    :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.description }"></textarea>
                                                <div v-if="errors.description" class="mt-1 text-red-500 text-sm">
                                                    {{ Array.isArray(errors.description) ? errors.description[0] : errors.description }}
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button 
                            @click="updateCategory" 
                            type="button"
                            :disabled="submitting || !name.trim()"
                            class="w-full inline-flex justify-center items-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg v-if="submitting" class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ submitting ? 'Mise à jour...' : 'Update Category' }}
                        </button>
                        <button 
                            @click="closeEditModal" 
                            type="button"
                            :disabled="submitting"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        <div v-if="successMessage" class="fixed bottom-4 right-4 z-50">
            <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-4 max-w-sm w-full border-green-200">
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
                        <button @click="successMessage = ''" class="inline-flex text-gray-400 hover:text-gray-500">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref, computed } from 'vue';
import api from '../../axios';
import { useAuthStore } from '../../stores/AuthStore';
import Sidebar from '../../components/Sidebar.vue';

// State management
const isOpen = ref(false);
const isEditOpen = ref(false);
const name = ref('');
const description = ref('');
const errors = ref({});
const categories = ref([]);
const loading = ref(true);
const submitting = ref(false);
const error = ref(null);
const editingCategory = ref(null);
const successMessage = ref('');
const searchTerm = ref('');

// API configuration
const auth = useAuthStore();

// Computed properties
const filteredCategories = computed(() => {
    if (!searchTerm.value) {
        return categories.value;
    }
    return categories.value.filter(category =>
        category.name.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
        (category.description && category.description.toLowerCase().includes(searchTerm.value.toLowerCase()))
    );
});

// Modal functions
function openModal() {
    isOpen.value = true;
    name.value = '';
    description.value = '';
    errors.value = {};
}

function closeModal() {
    isOpen.value = false;
    name.value = '';
    description.value = '';
    errors.value = {};
}

function openEditModal(category) {
    editingCategory.value = category;
    isEditOpen.value = true;
    name.value = category.name;
    description.value = category.description || '';
    errors.value = {};
}

function closeEditModal() {
    isEditOpen.value = false;
    editingCategory.value = null;
    name.value = '';
    description.value = '';
    errors.value = {};
}

// Search functions
function filterCategories() {
    // The filtering is handled by the computed property
}

function clearSearch() {
    searchTerm.value = '';
}

// Utility functions
function formatDate(dateString) {
    if (!dateString) return '';
    try {
        return new Date(dateString).toLocaleDateString('fr-FR', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    } catch (err) {
        return '';
    }
}

function showSuccess(message) {
    successMessage.value = message;
    setTimeout(() => {
        successMessage.value = '';
    }, 5000);
}

// API functions
async function fetchCategories() {
    loading.value = true;
    error.value = null;
    
    try {
        if (!auth.isAuthenticated) {
            throw new Error('Authentication required. Please log in again.');
        }

        // Try multiple possible endpoints
        let response;
        try {
            response = await api.get('/categories');
        } catch (err) {
            // Try alternative endpoint
            response = await api.get('/categories/list');
        }


        // Handle different response structures
        let categoriesData;
        if (response.data.categories) {
            categoriesData = response.data.categories;
        } else if (response.data.category) {
            categoriesData = response.data.category;
        } else if (response.data.data) {
            categoriesData = response.data.data;
        } else if (Array.isArray(response.data)) {
            categoriesData = response.data;
        } else {
            categoriesData = [];
        }

        categories.value = Array.isArray(categoriesData) ? categoriesData : [];

    } catch (err) {
        console.error('Error fetching categories:', err);
        
        if (err.response) {
            if (err.response.status === 401) {
                error.value = 'Session expired. Please log in again.';
                // Clear auth and redirect to login
                auth.clearAuth();
                window.location.href = '/login';
            } else if (err.response.status === 404) {
                error.value = 'Categories endpoint not found. Check API configuration.';
            } else if (err.response.status === 500) {
                error.value = 'Server error. Please try again later.';
            } else {
                error.value = err.response.data?.message || 'Error loading categories.';
            }
        } else if (err.code === 'ERR_NETWORK') {
            error.value = 'Cannot connect to server. Check that the backend is running.';
        } else if (err.message) {
            error.value = err.message;
        } else {
            error.value = 'Network error. Check your connection.';
        }
    } finally {
        loading.value = false;
    }
}

async function submitCategory() {
    if (submitting.value) return;
    
    submitting.value = true;
    errors.value = {};
    
    try {
        if (!auth.isAuthenticated) {
            throw new Error('Authentication required.');
        }

        const response = await api.post('/categories/create', {
            name: name.value.trim(),
            description: description.value.trim()
        });

        
        closeModal();
        await fetchCategories();
        showSuccess('Catégorie créée avec succès!');

    } catch (err) {
        console.error('Error creating category:', err);
        
        if (err.response) {
            if (err.response.status === 422) {
                // Validation errors
                errors.value = err.response.data.errors || {};
            } else if (err.response.status === 401) {
                error.value = 'Session expired. Please log in again.';
                // Clear auth and redirect to login
                auth.clearAuth();
                window.location.href = '/login';
            } else {
                error.value = err.response.data?.message || 'Error creating category.';
            }
        } else {
            error.value = 'Network error. Please try again.';
        }
    } finally {
        submitting.value = false;
    }
}

async function updateCategory() {
    if (submitting.value || !editingCategory.value) return;
    
    submitting.value = true;
    errors.value = {};
    
    try {
        if (!auth.isAuthenticated) {
            throw new Error('Authentication required.');
        }

        const response = await api.put(`/categories/${editingCategory.value.id}`, {
            name: name.value.trim(),
            description: description.value.trim()
        });

        
        closeEditModal();
        await fetchCategories();
        showSuccess('Catégorie mise à jour avec succès!');

    } catch (err) {
        console.error('Error updating category:', err);
        
        if (err.response) {
            if (err.response.status === 422) {
                // Validation errors
                errors.value = err.response.data.errors || {};
            } else if (err.response.status === 401) {
                error.value = 'Session expired. Please log in again.';
                // Clear auth and redirect to login
                auth.clearAuth();
                window.location.href = '/login';
            } else if (err.response.status === 404) {
                error.value = 'Category not found.';
            } else {
                error.value = err.response.data?.message || 'Error updating category.';
            }
        } else {
            error.value = 'Network error. Please try again.';
        }
    } finally {
        submitting.value = false;
    }
}


// Initialize component
onMounted(async () => {
    // Ensure auth is checked before loading data
    if (!auth.authChecked) {
        await auth.fetchUser();
    }
    fetchCategories();
});
</script>
