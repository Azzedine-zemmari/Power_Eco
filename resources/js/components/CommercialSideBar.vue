<template>
    <!-- Mobile menu button -->
    <div class="md:hidden">
        <button @click="isOpen = !isOpen" type="button" class="fixed top-4 right-4 z-50 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500">
            <span class="sr-only">Open sidebar</span>
            <svg class="h-6 w-6" :class="{ 'hidden': isOpen, 'block': !isOpen }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg class="h-6 w-6" :class="{ 'block': isOpen, 'hidden': !isOpen }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Mobile menu -->
    <div class="md:hidden" v-show="isOpen">
        <div class="fixed inset-0 flex z-40">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="isOpen = false"></div>
            <div class="relative flex-1 flex flex-col max-w-xs w-full bg-green-800">
                <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                    <div class="flex-shrink-0 flex items-center px-4">
                        <span class="text-white font-bold text-xl">
                            Eco<span class="text-green-300">Move</span>
                        </span>
                    </div>
                    <nav class="mt-5 px-2 space-y-1">
                        <SidebarLink to="salesList" icon="cube" label="Sales list" :active="current === '/saleList'" />
                        <LogoutButton variant="sidebar" />
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Desktop sidebar -->
    <div class="hidden md:flex md:flex-shrink-0">
        <div class="flex flex-col w-64 bg-green-800">
            <!-- Logo -->
            <div class="flex items-center h-16 flex-shrink-0 px-4 bg-green-900">
                <span class="text-white font-bold text-xl">
                    Eco<span class="text-green-300">Move</span>
                </span>
            </div>

            <div class="h-0 flex-1 flex flex-col overflow-y-auto">
                <!-- User Info -->
                <div class="flex items-center flex-shrink-0 px-4 py-4 border-b border-green-700">
                    <!-- Debug info (remove after fixing) -->
                    <div v-if="!user && !loading" class="text-red-300 text-xs mb-2">
                        Debug: {{ error || 'No user data' }}
                    </div>
                    
                    <!-- Loading state -->
                    <div v-if="loading" class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-green-700 animate-pulse"></div>
                        <div class="ml-3">
                            <div class="h-4 bg-green-700 rounded animate-pulse mb-1"></div>
                            <div class="h-3 bg-green-700 rounded animate-pulse w-20"></div>
                        </div>
                    </div>
                    
                    <!-- User data -->
                    <div v-else-if="user" class="flex items-center">
                        <div class="ml-3">
                            <p class="text-base font-medium text-white">
                                {{ user?.firstName || user?.firstname || user?.name || 'User' }} 
                                {{ user?.lastName || user?.lastname || '' }}
                            </p>
                            <p class="text-sm font-medium text-green-200">{{ user?.role || 'Commercial' }}</p>
                        </div>
                    </div>
                    
                    <!-- Error state -->
                    <div v-else class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-gray-400 flex items-center justify-center">
                                <span class="text-white text-sm">?</span>
                            </div>
                        </div>
                        <div class="ml-3">
                            <p class="text-base font-medium text-white">Unable to load user</p>
                            <button @click="fetchUserData" class="text-sm font-medium text-green-200 hover:text-white">
                                Retry
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="mt-5 px-2 space-y-1">
                    <SidebarLink to="salesList" icon="cube" label="Sales list" :active="current === '/saleList'" />
                    <LogoutButton variant="sidebar" />
                </nav>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import SidebarLink from './SidebarLink.vue'
import LogoutButton from './LogoutButton.vue'
import axios from 'axios'

const route = useRoute()
const current = route.path
const isOpen = ref(false)
const user = ref(null)
const loading = ref(false)
const error = ref(null)
const token = localStorage.getItem('token')

async function fetchUserData() {
    loading.value = true
    error.value = null
    
    console.log('Fetching user data...')
    console.log('Token exists:', !!token)
    
    try {
        if (!token) {
            throw new Error('No authentication token found')
        }

        const response = await axios.get('http://localhost:8000/api/user/data', {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        
        console.log(' User data response:', response.data)
        user.value = response.data
        
    } catch (err) {
        console.error('Error fetching user data:', err)
        console.error('Response:', err.response?.data)
        console.error('Status:', err.response?.status)
        
        if (err.response?.status === 401) {
            error.value = 'Authentication failed'
        } else if (err.response?.status === 404) {
            error.value = 'User endpoint not found'
        } else {
            error.value = err.response?.data?.message || err.message || 'Failed to load user data'
        }
    } finally {
        loading.value = false
    }
}

onMounted(() => {
    console.log('CommercialSideBar mounted')
    fetchUserData()
})
</script>