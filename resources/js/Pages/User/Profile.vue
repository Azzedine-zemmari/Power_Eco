<template>
<div class="bg-gray-50 text-gray-800 font-sans">
    <div class="flex h-screen overflow-hidden">
        <UserSideBar/>
        <!-- Main content -->
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
                <button type="button" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <!-- Top header -->
            <div class="flex-shrink-0 flex h-16 bg-white shadow">
                <div class="flex-1 px-4 flex justify-between">
                    <div class="flex-1 flex">
                        <h1 class="text-xl md:text-2xl font-semibold text-gray-900 self-center">Profile</h1>
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        <!-- Notification dropdown -->
                        <div class="ml-3 relative">
                            <button class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <span class="sr-only">View notifications</span>
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </button>
                        </div>
                        <!-- Profile dropdown -->
                        <div class="ml-3 relative">
                            <div>
                                <button type="button" class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <main class="flex-1 relative overflow-y-auto focus:outline-none">
                <div class="py-4 md:py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <h1 class="text-xl md:text-2xl font-semibold text-gray-900 mb-4">Welcome back, {{ profile.firstName }}</h1>
                    </div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <!-- Profile Information Section -->
                        <div class="bg-white shadow rounded-lg">
                            <!-- Profile Header -->
                            <div class="px-4 md:px-6 py-4 md:py-5 border-b border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                                <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>
                                <button 
                                    @click="toggleEdit" 
                                    :class="isEditing ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700'"
                                    class="w-full md:w-auto inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200"
                                >
                                    <svg v-if="!isEditing" class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    <svg v-else class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    {{ isEditing ? 'Cancel' : 'Edit Profile' }}
                                </button>
                            </div>

                            <!-- Profile Content -->
                            <div class="px-4 md:px-6 py-4 md:py-5">
                                <div class="grid grid-cols-1 gap-6">
                                    <!-- Profile Details -->
                                    <div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                            <!-- Full Name -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                                <input 
                                                    v-if="isEditing"
                                                    v-model="editProfile.firstName"
                                                    type="text"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                                                >
                                                <p v-else class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ profile.firstName }}</p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                                <input 
                                                    v-if="isEditing"
                                                    v-model="editProfile.lastName"
                                                    type="text"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                                                >
                                                <p v-else class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ profile.lastName }}</p>
                                            </div>

                                            <!-- Email -->
                                            <div class="md:col-span-2">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                                <input 
                                                    v-if="isEditing"
                                                    v-model="editProfile.email"
                                                    type="email"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                                                >
                                                <p v-else class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ profile.email }}</p>
                                            </div>
                                        </div>

                                        <!-- Member Since -->
                                        <div class="mt-6">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Member Since</label>
                                            <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ formatDate(profile.joinDate) }}</p>
                                        </div>

                                        <!-- Save Button (only visible when editing) -->
                                        <div v-if="isEditing" class="mt-6 flex justify-end">
                                            <button 
                                                @click="saveProfile"
                                                class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                            >
                                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Save Changes
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
</div>
</template>
<script setup>
import { ref, reactive, onMounted } from 'vue';
import LogoutButton from '../../components/LogoutButton.vue';
import UserSideBar from '../../components/UserSideBar.vue';
import axios from 'axios';

const isEditing = ref(false);

const profile = reactive({
    firstName: '',
    lastName:'',
    email: '',
    joinDate: ''
});

const editProfile = reactive({
    firstName: '',
    lastName:'',
    email: '',
});

// Fetch user data from API 
const fetchProfile = async () => {
    try {
        await axios.get('http://localhost:8000/sanctum/csrf-cookie', { withCredentials: true });
        const response = await axios.get('http://localhost:8000/api/user/data', {
            withCredentials: true,
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });

        Object.assign(profile, {
            firstName: response.data.firstName,
            lastName:response.data.lastName,
            email: response.data.email,
            joinDate: response.data.created_at
        });
        Object.assign(editProfile, {
            firstName: response.data.firstName,
            lastName:response.data.lastName,
            email: response.data.email,
        });
    } catch (error) {
        console.error(error);
    }
};


const toggleEdit = () => {
    if (isEditing.value) {
        // Reset edit profile to original values when canceling
        Object.assign(editProfile, {
            firstName: profile.firstName,
            lastName: profile.lastName,
            email: profile.email,
        });
    }
    isEditing.value = !isEditing.value;
};

const saveProfile = async () => {
    try {
        const response = await axios.put('http://localhost:8000/api/user/data/update', {
            firstName: editProfile.firstName,
            lastName: editProfile.lastName,
            email: editProfile.email,
        }, {
            withCredentials: true,
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        // Update the main profile with edited values
        Object.assign(profile, response.data);
        isEditing.value = false;
    } catch (error) {
        console.error(error);
        // Optionally show error to user
    }
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
};
onMounted(fetchProfile);
</script>