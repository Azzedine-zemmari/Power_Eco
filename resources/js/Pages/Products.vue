<template>
<div class="bg-gray-50 text-gray-800 font-sans">
    <Notification 
      :show="showNotification"
      title="Success!"
      :message="notificationMessage"
     @close="showNotification = false"
    />
    <Navbar/>
    
    <!-- Page Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">{{ $t('products.page_title') }}</h1>
        </div>
    </div>
    
    <!-- Product Listing with Sidebar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row py-6">
            <!-- Sidebar / Filters -->
            <div class="w-full md:w-64 mb-6 md:mb-0 md:mr-8">
                <div class="bg-white p-4 rounded-lg shadow sticky top-4">
                    <h2 class="font-bold text-lg mb-4">{{ $t('products.filters') }}</h2>
                    
                    <!-- Search -->
                    <div class="mb-6">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">{{ $t('products.search') }}</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input 
                                v-model="filters.search"
                                type="text"
                                name="search"
                                id="search"
                                class="focus:ring-green-500 focus:border-green-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md transition-colors duration-200"
                                :placeholder="$t('products.search_placeholder')"
                               @input="debounceSearch"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Categories -->
                    <div class="mb-6">
                        <h3 class="font-medium text-sm text-gray-900 mb-2">{{ $t('products.categories') }}</h3>
                        
                        <!-- Categories Loading Skeleton -->
                        <div v-if="!categories.length && categoriesLoading" class="space-y-2">
                            <div v-for="n in 3" :key="n" class="flex items-center animate-pulse">
                                <div class="h-4 w-4 bg-gray-200 rounded mr-2"></div>
                                <div class="h-4 bg-gray-200 rounded w-20"></div>
                            </div>
                        </div>
                        
                        <!-- Actual Categories -->
                        <div v-else-if="categories.length > 0" class="space-y-2">
                            <div v-for="category in categories" :key="category.id" class="flex items-center transition-all duration-200 hover:bg-gray-50 rounded p-1">
                                <input 
                                    :id="'category-' + category.id" 
                                    v-model="filters.categories"
                                    :value="category.id" 
                                    type="checkbox"
                                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded transition-colors duration-200"
                                    @change="applyFilters">
                                <label :for="'category-' + category.id" class="ml-2 text-sm text-gray-700 cursor-pointer">
                                    {{ category.name }}
                                </label>
                            </div>
                        </div>
                        
                        <!-- No Categories State -->
                        <div v-else class="text-sm text-gray-500 italic">
                            No categories available
                        </div>
                    </div>
                    
                    <!-- Price Range -->
                    <div class="mb-6">
                        <h3 class="font-medium text-sm text-gray-900 mb-2">{{ $t('products.price_range') }}</h3>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2">
                                <input 
                                    v-model="filters.minPrice"
                                    type="number"
                                    :placeholder="$t('products.min')"
                                   class="focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md transition-colors duration-200"
                                   @change="applyFilters"
                               >
                                <span class="text-gray-500">-</span>
                                <input 
                                    v-model="filters.maxPrice"
                                    type="number"
                                    :placeholder="$t('products.max')"
                                   class="focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md transition-colors duration-200"
                                   @change="applyFilters"
                               >
                            </div>
                        </div>
                    </div>
                    
                    <button 
                        @click="resetFilters"
                        type="button"
                        class="w-full bg-gray-100 border border-gray-300 rounded-md shadow-sm py-2 px-4 text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200"
                   >
                        {{ $t('products.reset_filters') }}
                    </button>
                </div>
            </div>
            
            <!-- Product Grid -->
            <div class="flex-1">
                <!-- Initial Loading State -->
                <div v-if="initialLoading" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="n in 6" :key="n" class="bg-white rounded-lg shadow-md overflow-hidden animate-pulse">
                        <!-- Image Skeleton -->
                        <div class="w-full h-48 bg-gray-200"></div>
                        <div class="p-4">
                            <!-- Title Skeleton -->
                            <div class="h-6 bg-gray-200 rounded mb-2"></div>
                            <!-- Description Skeleton -->
                            <div class="space-y-2 mb-4">
                                <div class="h-4 bg-gray-200 rounded w-full"></div>
                                <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                            </div>
                            <!-- Price and Button Skeleton -->
                            <div class="flex justify-between items-center">
                                <div class="h-6 bg-gray-200 rounded w-20"></div>
                                <div class="h-8 bg-gray-200 rounded w-24"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div v-else>
                    <TransitionGroup 
                        name="product-list" 
                        tag="div" 
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
                        appear
                    >
                        <div 
                            v-for="(product, index) in products.data" 
                            :key="product.id" 
                            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1"
                            :style="{ animationDelay: `${index * 50}ms` }"
                        >
                            <RouterLink :to="`/product/${product.id}`" class="block">
                                <div class="relative overflow-hidden">
                                    <img 
                                        class="w-full h-48 object-cover transition-transform duration-300 hover:scale-105" 
                                        :src="getImageUrl(product.image)" 
                                        :alt="product.name"
                                        @error="handleImageError"
                                        loading="lazy"
                                    >
                                    <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-10 transition-all duration-300"></div>
                                </div>
                            </RouterLink>
                            <div class="p-4">
                                <RouterLink :to="`/product/${product.id}`">
                                    <h3 class="text-lg font-semibold text-gray-900 hover:text-green-600 transition-colors duration-200 line-clamp-2">{{ product.name }}</h3>
                                </RouterLink>
                                <p class="mt-1 text-sm text-gray-500 line-clamp-2">{{ product.description }}</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <div class="flex flex-col">
                                        <p class="text-lg font-bold text-gray-900">{{ formatPrice(product.sell_price || product.price) }} MAD</p>
                                        <p v-if="product.sell_price && product.price !== product.sell_price" class="text-sm text-gray-500 line-through">{{ formatPrice(product.price) }} MAD</p>
                                    </div>
                                    <button 
                                        @click="addToCart(product)" 
                                        :disabled="addingToCart === product.id"
                                        type="button" 
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:scale-105"
                                    >
                                        <svg v-if="addingToCart === product.id" class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        {{ addingToCart === product.id ? 'Adding...' : $t('products.add_to_cart') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </TransitionGroup>
                    
                    <!-- Infinite Scroll Loading Indicator -->
                    <div v-if="loadingMore" class="flex justify-center items-center py-8">
                        <div class="flex items-center space-x-2 text-green-600">
                            <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span class="text-sm font-medium">Loading more products...</span>
                        </div>
                    </div>
                    
                    <!-- End of Results Indicator -->
                    <div v-if="!hasMore && products.data.length > 0" class="text-center py-8">
                        <div class="inline-flex items-center px-4 py-2 bg-gray-100 rounded-full">
                            <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-sm text-gray-600 font-medium">You've seen all products</span>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-if="!initialLoading && products.data.length === 0" class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No products found</h3>
                    <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
                </div>
            </div>
        </div>
    </div>
    <Footer/>
</div>
</template>

<script setup>
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';
import axios from 'axios';
import { onMounted, ref, computed, onUnmounted } from 'vue';
import { useCartStore } from '../stores/CartStore';
import { useRouter, useRoute, RouterLink } from 'vue-router';
import Notification from '../components/Notification.vue';
import { useI18n } from 'vue-i18n';
import api from '../axios';

const { t } = useI18n();

const products = ref({
    data: [],
    current_page: 1,
    last_page: 1,
    per_page: 6,
    total: 0
});

const categories = ref([]);
const initialLoading = ref(false);
const loadingMore = ref(false);
const addingToCart = ref(null);
const categoriesLoading = ref(false);

const filters = ref({
    search: '',
    categories: [],
    minPrice: '',
    maxPrice: '',
});

const cart = useCartStore();
const route = useRoute();
const router = useRouter();
const showNotification = ref(false);
const notificationMessage = ref('');

const isAuthenticated = computed(() => {
    return !!localStorage.getItem('token');
});

const hasMore = computed(() => products.value.current_page < products.value.last_page);

const token = localStorage.getItem('token');

// Utility functions
const formatPrice = (price) => {
    const numPrice = parseFloat(price) || 0;
    return new Intl.NumberFormat('fr-FR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(numPrice);
};

const getImageUrl = (imagePath) => {
    if (!imagePath) return '/placeholder.svg?height=200&width=200';
    if (imagePath.startsWith('http')) return imagePath;
    return `http://localhost:8000/storage/${imagePath}`;
};

const handleImageError = (event) => {
    event.target.src = '/placeholder.svg?height=200&width=200';
};

const fetchCategories = async () => {
    categoriesLoading.value = true;
    try {
        const response = await api.get('/categories');
        
        // Handle different response structures
        if (response.data && Array.isArray(response.data.categories)) {
            categories.value = response.data.categories;
        } else if (response.data && Array.isArray(response.data.data)) {
            categories.value = response.data.data;
        } else if (Array.isArray(response.data)) {
            categories.value = response.data;
        } else {
            categories.value = [];
        }
        
        console.log('Categories loaded:', categories.value);
    } catch (error) {
        console.error('Error fetching categories:', error);
        categories.value = [];
    } finally {
        categoriesLoading.value = false;
    }
};

const buildQueryParams = () => {
    const params = new URLSearchParams();
    
    if (filters.value.search) {
        params.append('search', filters.value.search);
    }
    
    if (filters.value.categories.length > 0) {
        params.append('category', filters.value.categories.join(','));
    }
    
    if (filters.value.minPrice) {
        params.append('min_price', filters.value.minPrice);
    }
    
    if (filters.value.maxPrice) {
        params.append('max_price', filters.value.maxPrice);
    }
    
    return params.toString();
};
const fetchProducts = async (page = 1, append = false) => {
    if (page === 1) {
        initialLoading.value = true;
    } else {
        loadingMore.value = true;
    }
    
    try {
        const queryParams = buildQueryParams();
        const url = `http://localhost:8000/api/products?page=${page}&per_page=6${queryParams ? '&' + queryParams : ''}`;
        
        const response = await api.get(url);
        
        const newProducts = response.data;
        
        if (append && page > 1) {
            // Smooth append for infinite scroll
            setTimeout(() => {
                products.value.data.push(...newProducts.data);
                products.value.current_page = newProducts.current_page;
                products.value.last_page = newProducts.last_page;
                products.value.total = newProducts.total;
            }, 300); // Small delay for smooth transition
        } else {
            products.value = newProducts;
        }
    } catch (error) {
        console.error('Error fetching products:', error);
    } finally {
        initialLoading.value = false;
        loadingMore.value = false;
    }
};

const applyFilters = () => {
    fetchProducts(1, false);
};

const resetFilters = () => {
    filters.value = {
        search: '',
        categories: [],
        minPrice: '',
        maxPrice: '',
    };
    fetchProducts(1, false);
};

// Improved scroll handling with throttling
let scrollTimeout;
const handleScroll = () => {
    if (scrollTimeout) return;
    
    scrollTimeout = setTimeout(() => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const windowHeight = window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight;
        
        // Trigger when user is 300px from bottom
        const bottomReached = scrollTop + windowHeight >= documentHeight - 300;
        
        if (bottomReached && hasMore.value && !loadingMore.value && !initialLoading.value) {
            fetchProducts(products.value.current_page + 1, true);
        }
        
        scrollTimeout = null;
    }, 100); // Throttle scroll events
};

// Debounce search input
let searchTimeout;
const debounceSearch = () => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        applyFilters();
    }, 500);
};

const addToCart = async (product) => {
    if (!isAuthenticated.value) {
        router.push(`/login?redirect=${route.fullPath}`);
        return;
    }
    
    addingToCart.value = product.id;
    
    try {
        await api.post('/cart/add', {
            product_id: product.id,
            quantity: 1
        });
        
        cart.cartCount += 1;
        notificationMessage.value = t('cart.added_message', {
            product: product.name
        });
        showNotification.value = true;
    } catch (error) {
        console.error(error);
    } finally {
        addingToCart.value = null;
    }
};

const fetchInitialData = () => {
    fetchProducts();
    fetchCategories();
};

onMounted(() => {
    fetchInitialData();
    window.addEventListener('scroll', handleScroll, { passive: true });
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
    clearTimeout(searchTimeout);
    clearTimeout(scrollTimeout);
});
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Product list transitions */
.product-list-enter-active {
    transition: all 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.product-list-enter-from {
    opacity: 0;
    transform: translateY(30px) scale(0.95);
}

.product-list-enter-to {
    opacity: 1;
    transform: translateY(0) scale(1);
}

.product-list-move {
    transition: transform 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
}

/* Staggered animation for initial load */
.product-list-enter-active:nth-child(1) { animation-delay: 0ms; }
.product-list-enter-active:nth-child(2) { animation-delay: 100ms; }
.product-list-enter-active:nth-child(3) { animation-delay: 200ms; }
.product-list-enter-active:nth-child(4) { animation-delay: 300ms; }
.product-list-enter-active:nth-child(5) { animation-delay: 400ms; }
.product-list-enter-active:nth-child(6) { animation-delay: 500ms; }

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

/* Smooth hover effects */
.hover\:scale-105:hover {
    transform: scale(1.05);
}

.hover\:-translate-y-1:hover {
    transform: translateY(-4px);
}
</style>
