<template>
    <div>
        <!-- Mobile menu button -->
        <div class="md:hidden fixed top-0 left-0 w-full bg-green-800 p-4 z-50">
            <button @click="isOpen = !isOpen" class="text-white">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path v-if="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Sidebar -->
        <div :class="[
            'fixed inset-y-0 left-0 transform transition-transform duration-200 ease-in-out z-40 h-screen',
            isOpen ? 'translate-x-0' : '-translate-x-full',
            'md:translate-x-0 md:static md:flex md:flex-shrink-0'
        ]">
            <div class="flex flex-col w-64 bg-green-800 h-full">
                <!-- Logo -->
                <a href="/" class="flex items-center h-16 flex-shrink-0 px-4 bg-green-900">
                    <span class="text-white font-bold text-xl">
                        Eco<span class="text-green-300">Move</span>
                    </span>
                </a>

                <div class="h-0 flex-1 flex flex-col overflow-y-auto">
                    <!-- User Info -->
                    <div class="flex items-center flex-shrink-0 px-4 py-4 border-b border-green-700">
                        <div class="ml-3">
                            <p class="text-base font-medium text-white">{{ user?.firstName }} {{ user?.lastName }}</p>
                            <p class="text-sm font-medium text-green-200">User</p>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <nav class="mt-5 px-2 space-y-1">
                        <SidebarLink to="/user/profile" icon="user" label="Profile"
                            :active="current === '/user/profile'" />
                        <SidebarLink to="/user/devis" icon="folder" label="Devis"
                            :active="current === '/user/devis'" />
                        <SidebarLink to="/user/facture" icon="cube" label="Facture"
                            :active="current === '/user/facture'" />
                        <LogoutButton variant="sidebar" />
                    </nav>
                </div>
            </div>
        </div>

        <!-- Overlay for mobile -->
        <div v-if="isOpen" 
             class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"
             @click="isOpen = false">
        </div>
    </div>
</template>

<script setup>
import { useRoute } from 'vue-router'
import SidebarLink from './SidebarLink.vue'
import LogoutButton from './LogoutButton.vue'
import { onMounted, ref } from 'vue'
import axios from 'axios'

const route = useRoute()
const current = route.path
const isOpen = ref(false)
const user = ref('')

const userData = async () =>{
    try{
        const response = await axios.get('http://localhost:8000/api/user/data',{
            headers:{
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        })
        user.value = response.data
        console.log(user.value);
        
    }catch(error){
        console.error(error);      
    }
}
onMounted(userData)
</script>
