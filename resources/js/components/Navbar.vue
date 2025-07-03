<template>
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex-shrink-0 flex items-center">
                        <span class="text-blue-800 font-bold text-xl uppercase">Mobile<span
                                class="text-green-800 uppercase">Sun</span></span>
                    </a>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="/"
                            class="border-green-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            {{ $t('nav.links.home') }}
                        </a>
                        <a href="/products"
                            class="border-transparent text-gray-500 hover:border-green-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            {{ $t('nav.links.products') }}
                        </a>
                        <a v-if="dashboardLink" :href="dashboardLink"
                            class="border-transparent text-gray-500 hover:border-green-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            {{ $t('nav.links.dashboard') }}
                        </a>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <div class="ml-4 flex items-center md:ml-6 space-x-4">
                        <a href="/cart"
                            class="relative p-1 rounded-full text-gray-600 hover:text-gray-800 focus:outline-none">
                            <span class="sr-only">{{ $t('nav.links.cart') }}</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>

                            <!-- Cart Count Badge -->
                            <span v-if="cartStore.cartCount && cartStore.cartCount > 0"
                                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                {{ cartStore.cartCount }}
                            </span>
                        </a>
                        <LanguageSwitcher variant="navbar" />

                        <div v-if="isAuthenticated" class="flex items-center space-x-4">
                            <a href="/user/profile"
                                class="p-1 rounded-full text-gray-600 hover:text-gray-800 focus:outline-none">
                                <span class="sr-only">{{ $t('nav.links.profile') }}</span>
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </a>
                            <LogoutButton variant="default" />
                        </div>
                        <div v-else>
                            <a href="/login" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">{{
                                $t('nav.links.login') }}</a>
                        </div>
                    </div>
                </div>
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="isMobileMenuOpen = !isMobileMenuOpen" type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none"
                        aria-expanded="false">
                        <span class="sr-only">{{ $t('nav.aria.open_menu') }}</span>
                        <!-- Icon when menu is closed -->
                        <svg v-if="!isMobileMenuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- Icon when menu is open -->
                        <svg v-else class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div v-show="isMobileMenuOpen" class="sm:hidden z-0">
            <div class="pt-2 pb-3 space-y-1">
                <a href="/"
                    class="bg-green-50 border-green-500 text-green-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    {{ $t('nav.links.home') }}
                </a>
                <a href="/products"
                    class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-green-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    {{ $t('nav.links.products') }}
                </a>
                <a v-if="dashboardLink" :href="dashboardLink"
                    class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-green-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    {{ $t('nav.links.dashboard') }}
                </a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items-center px-4 space-x-4">
                    <a href="/cart"
                        class="relative p-1 rounded-full text-gray-600 hover:text-gray-800 focus:outline-none">
                        <span class="sr-only"></span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span v-if="cartStore.cartCount && cartStore.cartCount > 0"
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                            {{ cartStore.cartCount }}
                        </span>
                    </a>
                    <LanguageSwitcher variant="sidebar" />
                    <div v-if="isAuthenticated" class="flex items-center space-x-4">
                        <a href="/user/profile"
                            class="p-1 rounded-full text-gray-600 hover:text-gray-800 focus:outline-none">
                            <span class="sr-only">{{ $t('nav.links.profile') }}</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </a>
                        <LogoutButton variant="default" />
                    </div>
                    <div v-else>
                        <a href="/login" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">{{
                            $t('nav.links.login') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
<script setup>
import LogoutButton from './LogoutButton.vue';
import { useCartStore } from '../stores/CartStore';
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import { useI18n } from 'vue-i18n';
import LanguageSwitcher from './LanguageSwitcher.vue';


const cartStore = useCartStore();
const isMobileMenuOpen = ref(false);


const isAuthenticated = computed(() => {
    return !!localStorage.getItem('token');
} )
const user = ref({})
const token = localStorage.getItem('token')

async function fetchUserData() {
    try {
        const response = await axios.get('http://localhost:8000/api/user/data', {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });
        user.value = response.data;
        console.log('navbar : ', user.value);
        
    } catch (error) {
        console.error('Error fetching user data:', error);
    }
}

const dashboardLink = computed(() => {                                                          
    if (!user.value?.selectedRole) return null;
    switch (user.value.selectedRole) {
        case 'admin':
            return '/admin/users/management';
        case 'product-manager':
            return '/productManager/dashboard';
        case 'commercial':
            return '/saleList';
        default:
            return null;
    }
});
    onMounted(() => {
         if (isAuthenticated.value) {
        fetchUserData();
    }
        cartStore.fetchCartCount();
    });
</script>