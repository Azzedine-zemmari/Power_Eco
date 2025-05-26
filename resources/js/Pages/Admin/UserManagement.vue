<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <!-- Admin Navigation -->
        <nav class="bg-green-800 shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="admin-dashboard.html" class="flex-shrink-0 flex items-center">
                            <span class="text-white font-bold text-xl">Eco<span class="text-green-300">Move</span></span>
                        </a>
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <a href="admin-user-management.html"
                                class="border-green-300 text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                User Management
                            </a>
                        </div>
                    </div>
                    <div class="flex justify-end items-center">
                        <LogoutButton variant="default"/>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">User Management</h1>
                <button type="button" @click="openModal"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                    id="open-create-user-modal">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Create User
                </button>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- User Creation Form (Modal) -->
            <div v-if="isModalOpen" class="fixed z-50 inset-0 overflow-y-auto" id="create-user-modal"
                @click.self="closeModal">
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
                                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Create New User</h3>
                                    <div class="mt-4">
                                        <form @submit.prevent="submitForm" id="create-user-form" class="space-y-6">
                                            <!-- Personal Information -->
                                            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                                <div>
                                                    <label for="first-name"
                                                        class="block text-sm font-medium text-gray-700">First
                                                        name</label>
                                                    <div class="mt-1">
                                                        <input v-model="firstName" type="text" id="first-name"
                                                            name="first-name" required
                                                            class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="last-name"
                                                        class="block text-sm font-medium text-gray-700">Last
                                                        name</label>
                                                    <div class="mt-1">
                                                        <input v-model="lastName" type="text" id="last-name"
                                                            name="last-name" required
                                                            class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                </div>

                                                <div class="sm:col-span-2">
                                                    <label for="email"
                                                        class="block text-sm font-medium text-gray-700">Email
                                                        address</label>
                                                    <div class="mt-1">
                                                        <input v-model="email" type="email" id="email" name="email"
                                                            required
                                                            class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                </div>


                                            </div>

                                            <!-- Role Selection -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">User Role</label>
                                                <div class="mt-2 space-y-4">
                                                    <div class="flex items-center">
                                                        <input id="role-commercial" name="user-role"
                                                            v-model="selectedRole" type="radio" value="commercial"
                                                            class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300"
                                                            checked>
                                                        <label for="role-commercial"
                                                            class="ml-3 block text-sm font-medium text-gray-700">
                                                            Commercial
                                                        </label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input id="role-product-manager" name="user-role"
                                                            v-model="selectedRole" type="radio" value="product-manager"
                                                            class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300">
                                                        <label for="role-product-manager"
                                                            class="ml-3 block text-sm font-medium text-gray-700">
                                                            Product Manager
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                <button type="submit"
                                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
                                                    id="create-user-submit">
                                                    Create User
                                                </button>
                                                <button type="button" @click="closeModal"
                                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                                    id="close-modal">
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

            <!-- User List -->
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Users</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">A list of all users in the system.</p>
                    </div>
                    <div class="flex items-center">
                        <div class="relative">
                            <input type="text" name="search" id="search" placeholder="Search users..."
                                class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <select id="role-filter" name="role-filter"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                <option value="">All Roles</option>
                                <option value="commercial">Commercial</option>
                                <option value="product-manager">Product Manager</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        FirstName
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        LastName
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- User Row 1 -->
                                <tr v-for="user in users" :key="user.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ user.firstName }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ user.lastName }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ user.email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ user.selectedRole }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-xnowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ user.status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button @click="archiveUser(user.id)"
                                            class="text-red-600 hover:text-red-900"><svg
                                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                                <path fill-rule="evenodd"
                                                    d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <button v-if="user.selectedRole == 'user'" @click="activeUser(user.id)"
                                            class="text-green-600 hover:text-green-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="#"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Previous
                        </a>
                        <a href="#"
                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Next
                        </a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of
                                <span class="font-medium">12</span> users
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                aria-label="Pagination">
                                <a href="#"
                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="#" aria-current="page"
                                    class="z-10 bg-green-50 border-green-500 text-green-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    1
                                </a>
                                <a href="#"
                                    class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    2
                                </a>
                                <a href="#"
                                    class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    3
                                </a>
                                <a href="#"
                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
<script setup>
import axios from 'axios'
import { ref, onMounted } from 'vue'
import LogoutButton from '../../components/LogoutButton.vue'

const isModalOpen = ref(false)
const firstName = ref('')
const lastName = ref('')
const email = ref('')
const selectedRole = ref('')
const users = ref([])

function openModal() {
    isModalOpen.value = true
}

function closeModal() {
    console.log('closeModal called')
    isModalOpen.value = false
}

onMounted(async () => {
    await fetchUsers()
})

async function fetchUsers() {
    try {
        const response = await axios.get('http://localhost:8000/api/Users')
        users.value = response.data
    } catch (error) {
        console.error('Error fetching users:', error)
    }
}

async function submitForm() {
    if (!firstName.value || !lastName.value || !email.value) {
        alert('Please fill in all required fields.')
        return
    }
    // Close the modal
    isModalOpen.value = false
    
    const formData = {
        firstName: firstName.value,
        lastName: lastName.value,
        email: email.value,
        selectedRole: selectedRole.value
    }
    
    try {
        const response = await axios.post("http://localhost:8000/api/register", formData)
        // Refresh the user list from backend after successful registration
        await fetchUsers();
        // Reset form fields
        firstName.value = ''
        lastName.value = ''
        email.value = ''
        selectedRole.value = ''
        // Show success message
        alert(`User ${response.data.user.firstName} created successfully!`)
    } catch (error) {
        console.error('Error creating user:', error)
    }
}

const token = localStorage.getItem('token')

async function archiveUser(userId) {
    if (!confirm("Are you sure you want to archive this user?")) return;

    try {
        await axios.delete(`http://localhost:8000/api/users/${userId}/archive`, {
            headers: {
                Authorization: `Bearer ${token}`,
                Accept: 'application/json'
            }
        })
        // remove user from local state
        users.value = users.value.filter(user => user.id !== userId);
        alert('User archived successfully');
    } catch (error) {
        console.error(error);
        alert('Failed to archive user.');
    }
}

async function activeUser(userId) {
    if (!confirm("Are you sure you want to activate this user?")) return;
    
    try {
        await axios.post(`http://localhost:8000/api/users/${userId}/active`, {}, {
            headers: {
                Authorization: `Bearer ${token}`,
                Accept: 'application/json'
            }
        })
        
        // Refresh the user list to show updated status
        await fetchUsers();
        
        alert('User activated successfully');
    } catch (err) {
        console.error(err);
        alert('Failed to activate user.');
    }
}
</script>
