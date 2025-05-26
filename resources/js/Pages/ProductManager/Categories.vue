<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <Sidebar/>

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
                            <h1 class="text-2xl font-semibold text-gray-900 self-center">Categories</h1>
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
                                                <input type="text" name="search" id="search"
                                                    class="focus:ring-green-500 focus:border-green-500 block w-full rounded-md pl-10 sm:text-sm border-gray-300"
                                                    placeholder="Search categories">
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
                                </div>

                                <!-- Categories list -->
                                <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-md">
                                    <div v-if="loading">Loading...</div>
                                    <div v-else-if="error">{{ error }}</div>
                                    <ul v-else class="divide-y divide-gray-200">
                                        <li v-for="category in categories" :key="category.id">
                                            <div class="px-4 py-4 flex items-center sm:px-6">
                                                <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                                    <div>
                                                        <div class="flex text-sm">
                                                            <p class="font-medium text-green-600 truncate">
                                                                {{ category.name }}</p>
                                                        </div>
                                                        <div class="mt-2 flex">
                                                            <div class="flex items-center text-sm text-gray-500">
                                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor">
                                                                    <path
                                                                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                                                </svg>
                                                                {{ category.description }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4 flex-shrink-0 sm:mt-0">
                                                        <div class="flex space-x-4">
                                                            <button type="button"
                                                                class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
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
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Create New Category</h3>
                                <div class="mt-4">
                                    <form @submit.prevent="submitCategory" id="create-category-form" class="space-y-6">
                                        <div>
                                            <label for="category-name"
                                                class="block text-sm font-medium text-gray-700">Category Name</label>
                                            <div class="mt-1">
                                                <input v-model="name" type="text" id="category-name" name="category-name" required
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                <div v-if="errors.name" class="text-red-500 text-sm">{{ errors.name[0]
                                                    }}</div>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="category-description"
                                                class="block text-sm font-medium text-gray-700">Description</label>
                                            <div class="mt-1">
                                                <textarea v-model="description" id="category-description" name="category-description" rows="3"
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                                                <div v-if="errors.description" class="text-red-500 text-sm">{{
                                                    errors.description[0] }}</div>
                                            </div>
                                            <p class="mt-2 text-sm text-gray-500">Brief description of the category.</p>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <button type="submit" id="save-category-btn"
                                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                Save Category
                                            </button>
                                            <button @click="openModal" type="button" id="cancel-category-btn"
                                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Category Modal -->
        <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="edit-category-modal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" id="edit-modal-backdrop"></div>

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
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Category</h3>
                                <div class="mt-4">
                                    <form id="edit-category-form" class="space-y-6">
                                        <input type="hidden" id="edit-category-id" name="edit-category-id">
                                        <div>
                                            <label for="edit-category-name"
                                                class="block text-sm font-medium text-gray-700">Category Name</label>
                                            <div class="mt-1">
                                                <input type="text" id="edit-category-name" name="edit-category-name"
                                                    required
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                        </div>

                                        <div>
                                            <label for="edit-category-description"
                                                class="block text-sm font-medium text-gray-700">Description</label>
                                            <div class="mt-1">
                                                <textarea id="edit-category-description"
                                                    name="edit-category-description" rows="3"
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="edit-category-status"
                                                class="block text-sm font-medium text-gray-700">Status</label>
                                            <div class="mt-1">
                                                <select id="edit-category-status" name="edit-category-status"
                                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                    <option value="draft">Draft</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" id="update-category-btn"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Update Category
                        </button>
                        <button type="button" id="cancel-edit-btn"
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
import { onMounted, ref } from 'vue';
import axios from 'axios';
import LogoutButton from '../../components/LogoutButton.vue';
import Sidebar from '../../components/Sidebar.vue';
const isOpen = ref(false);
const name = ref('');
const description = ref('');
const errors = ref({});
const categories = ref([])
const loading = ref(true)
const error = ref(null)

function openModal() {
    isOpen.value = !isOpen.value;
    name.value = '';
    description.value = '';
    errors.value = {};
}

const token = localStorage.getItem('token')

async function submitCategory() {
    try {
        // First, get CSRF cookie from Laravel Sanctum
        await axios.get('http://localhost:8000/sanctum/csrf-cookie', { withCredentials: true });

        // send the POST request with credentials
        const response = await axios.post(
            'http://localhost:8000/api/categories/create',
            {
                name: name.value,
                description: description.value
            },
            {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                }
            }
        );

        // Clear errors and close modal on success
        errors.value = {};
        openModal();
        await fetchCategories();

    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            errors.value = error.response.data.errors;
        } else {
            console.error('Error submitting category:', error);
        }
    }
}
async function fetchCategories(){
    try{
        const response = await axios.get('http://localhost:8000/api/categories',{
            withCredentials:true,
            headers :{
                Accept :'application/json',
                Authorization : `Bearer ${token}`

            }
        })
        categories.value = response.data.category || response.data;
    }catch(error){
        error.value = 'Failed to load categories'
        console.error(error)
    } finally{
        loading.value = false;
    }
}
onMounted(()=>{
    fetchCategories();
})
</script>

