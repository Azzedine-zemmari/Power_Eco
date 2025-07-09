<template>
<div class="bg-gray-50 text-gray-800 font-sans">
    <Navbar/>
    
    <!-- Hero Section -->
    <div class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100" />
                </svg>
                <div class="pt-10 sm:pt-16 lg:pt-8 lg:pb-14 lg:overflow-hidden">
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div class="lg:grid lg:grid-cols-2 lg:gap-8">
                            <div class="mx-auto max-w-md px-4 sm:max-w-2xl sm:px-6 sm:text-center lg:px-0 lg:text-left lg:flex lg:items-center">
                                <div class="lg:py-24">
                                    <h1 class="mt-4 text-4xl tracking-tight font-extrabold text-gray-900 sm:mt-5 sm:text-5xl lg:mt-6 xl:text-6xl">
                                        <span class="block">{{ $t('home.hero.title_1') }}</span>
                                        <span class="block text-green-600">{{ $t('home.hero.title_2') }}</span>
                                    </h1>
                                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                                        {{ $t('home.hero.description') }}
                                    </p>
                                    <div class="mt-8 sm:mt-12">
                                        <a href="/products" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            {{ $t('home.hero.shop_now') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="/public/photo-1497440001374-f26997328c1b.avif" loading="lazy" alt="{{ $t('home.hero.image_alt') }}">
        </div>
    </div>
    
    <!-- Featured Products -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto py-16 sm:py-24 lg:py-32 lg:max-w-none">
                <h2 class="text-3xl font-extrabold text-gray-900">{{ $t('home.featured_products.title') }}</h2>
                
                <!-- Loading Skeleton -->
                <div v-if="loading" class="mt-6 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-4 lg:gap-x-6">
                    <div v-for="n in 4" :key="n" class="group relative animate-pulse">
                        <!-- Image Skeleton -->
                        <div class="relative w-full h-80 bg-gray-200 rounded-lg overflow-hidden sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                            <div class="w-full h-full bg-gray-300"></div>
                        </div>
                        <!-- Content Skeleton -->
                        <div class="mt-6 space-y-2">
                            <!-- Product name skeleton -->
                            <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                            <!-- Price skeleton -->
                            <div class="h-5 bg-gray-200 rounded w-1/2"></div>
                            <!-- Stock skeleton -->
                            <div class="h-4 bg-gray-200 rounded w-2/3"></div>
                        </div>
                    </div>
                </div>

                <!-- Actual Products -->
                <div v-else-if="featuredProducts.length > 0" class="mt-6 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-4 lg:gap-x-6">
                    <div v-for="product in featuredProducts" :key="product.id" class="group relative">
                        <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                            <img 
                                :src="getImageUrl(product.image)" 
                                :alt="product.name" 
                                class="w-full h-full object-center object-cover"
                                @error="handleImageError"
                                loading="lazy"
                            >
                        </div>
                        <h3 class="mt-6 text-sm text-gray-500">
                            <RouterLink :to="`product/${product.id}`" class="hover:text-green-600 transition-colors">
                                <span class="absolute inset-0"></span>
                                {{ product.name }}
                            </RouterLink>
                        </h3>
                        <div class="flex items-center space-x-2">
                            <p class="text-base font-semibold text-gray-900">{{ formatPrice(product.sell_price) }} MAD</p>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-else class="mt-6 text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No featured products</h3>
                    <p class="mt-1 text-sm text-gray-500">Check back later for featured products.</p>
                    <div class="mt-6">
                        <a href="/products" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                            Browse All Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sustainability Section -->
    <div class="bg-green-700">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">{{ $t('home.sustainability.title_1') }}</span>
                <span class="block text-green-200">{{ $t('home.sustainability.title_2') }}</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="/products" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-green-600 bg-white hover:bg-green-50">
                        {{ $t('home.sustainability.shop_products') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <Footer/>
</div>
</template>

<script setup>
import LogoutButton from '../components/LogoutButton.vue';
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue'
import { ref, onMounted } from 'vue';
import axios from 'axios';
import api from '../axios';

const featuredProducts = ref([]);
const loading = ref(false);

// Utility functions
const formatPrice = (price) => {
    const numPrice = parseFloat(price) || 0;
    return new Intl.NumberFormat('fr-FR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(numPrice);
};

const getImageUrl = (imagePath) => {
    if (!imagePath) return '/placeholder.svg?height=320&width=320';
    if (imagePath.startsWith('http')) return imagePath;
    return `http://localhost:8000/storage/${imagePath}`;
};

const handleImageError = (event) => {
    event.target.src = '/placeholder.svg?height=320&width=320';
};

const fetchFeaturedProducts = async () => {
    loading.value = true;
    try {
        const response = await api.get('/featured-products');
        
        // Handle different response structures
        if (response.data && Array.isArray(response.data.data)) {
            featuredProducts.value = response.data.data;
        } else if (Array.isArray(response.data)) {
            featuredProducts.value = response.data;
        } else {
            featuredProducts.value = [];
        }
    } catch (error) {
        console.error('Error fetching featured products:', error);
        featuredProducts.value = [];
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchFeaturedProducts();
});
</script>

<style scoped>
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .5;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.line-through {
    text-decoration: line-through;
}
</style>
