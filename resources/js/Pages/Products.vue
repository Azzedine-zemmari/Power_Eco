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
                <div class="bg-white p-4 rounded-lg shadow">
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
                                class="focus:ring-green-500 focus:border-green-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md"
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
                        <div class="space-y-2">
                            <div v-for="category in categories" :key="category.id" class="flex items-center">
                                <input 
                                    :id="'category-' + category.id"
                                    v-model="filters.categories"
                                    :value="category.id"
                                   type="checkbox"
                                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                                   @change="applyFilters"
                               >
                                <label :for="'category-' + category.id" class="ml-2 text-sm text-gray-700">{{ category.name }}</label>
                            </div>
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
                                    :placeholder=" $t('products.min') "
                                   class="focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                   @change="applyFilters"
                               >
                                <span class="text-gray-500">-</span>
                                <input 
                                    v-model="filters.maxPrice"
                                    type="number"
                                    :placeholder=" $t('products.max') "
                                   class="focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                   @change="applyFilters"
                               >
                            </div>
                        </div>
                    </div>
                    
                    <button 
                        @click="resetFilters"
                        type="button"
                        class="w-full bg-gray-100 border border-gray-300 rounded-md shadow-sm py-2 px-4 text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                   >
                        {{ $t('products.reset_filters') }}
                    </button>
                </div>
            </div>
            
            <!-- Product Grid -->
            <div class="flex-1">
                <!-- Loading State -->
                <div v-if="loading" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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
                <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="product in products.data" :key="product.id" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200">
                        <a :href="`/product/${product.id}`">
                            <img 
                                class="w-full h-48 object-cover" 
                                :src="getImageUrl(product.image)" 
                                :alt="product.name"
                                @error="handleImageError"
                                loading="lazy"
                            >
                        </a>
                        <div class="p-4">
                            <a :href="`/product/${product.id}`">
                                <h3 class="text-lg font-semibold text-gray-900 hover:text-green-600 transition-colors">{{ product.name }}</h3>
                            </a>
                            <p class="mt-1 text-sm text-gray-500 line-clamp-2">{{ product.description }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <div class="flex flex-col">
                                    <p class="text-lg font-bold text-gray-900">{{ formatPrice(product.sell_price) }} MAD</p>
                                </div>
                                <button 
                                    @click="addToCart(product)" 
                                    :disabled="addingToCart === product.id"
                                    type="button" 
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed"
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
                </div>

                <!-- Empty State -->
                <div v-if="!loading && products.data.length === 0" class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No products found</h3>
                    <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
                </div>
                
                <!-- Pagination -->
                <div v-if="!loading && products.data.length > 0" class="mt-8 flex justify-center">
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <!-- Previous Page -->
                        <button 
                            @click="changePage(products.current_page - 1)"
                           :disabled="products.current_page === 1 || loading"
                           class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
                       >
                            <span class="sr-only">{{ $t('products.previous') }}</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <!-- Page Numbers -->
                        <template v-for="page in totalPages" :key="page">
                            <button 
                                @click="changePage(page)"
                               :disabled="loading"
                               :class="[
                                   'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium',
                                   page === products.current_page
                                        ? 'text-green-600 bg-green-50 border-green-500'
                                        : 'text-gray-700 hover:bg-gray-50',
                                   loading ? 'opacity-50 cursor-not-allowed' : ''
                               ]"
                           >
                                {{ page }}
                            </button>
                        </template>
                        <!-- Next Page -->
                        <button 
                            @click="changePage(products.current_page + 1)"
                           :disabled="products.current_page === products.last_page || loading"
                           class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
                       >
                            <span class="sr-only">{{ $t('products.next') }}</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </nav>
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
import { onMounted, ref, computed, watch } from 'vue';
import { useCartStore } from '../stores/CartStore';
import { useRouter, useRoute } from 'vue-router';
import Notification from '../components/Notification.vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const products = ref({
    data: [],
    current_page: 1,
    last_page: 1,
    per_page: 6,
    total: 0
});

const categories = ref([]);
const loading = ref(false);
const addingToCart = ref(null);

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

const totalPages = computed(() => {
    return products.value.last_page;
});

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
    try {
        const response = await axios.get('http://localhost:8000/api/categories', {
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${token}`
            }
        });
        categories.value = response.data;
    } catch (error) {
        console.error('Error fetching categories:', error);
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

const fetchProducts = async (page = 1) => {
    loading.value = true;
    try {
        const queryParams = buildQueryParams();
        const url = `http://localhost:8000/api/products?page=${page}&per_page=6${queryParams ? '&' + queryParams : ''}`;
        
        const response = await axios.get(url, {
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${token}`
            }
        });
        products.value = response.data;
    } catch (error) {
        console.error('Error fetching products:', error);
    } finally {
        loading.value = false;
    }
};

const changePage = (page) => {
    if (page >= 1 && page <= products.value.last_page && !loading.value) {
        fetchProducts(page);
    }
};

const applyFilters = () => {
    fetchProducts(1);
};

const resetFilters = () => {
    filters.value = {
        search: '',
        categories: [],
        minPrice: '',
        maxPrice: '',
    };
    fetchProducts(1);
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
        await axios.post('/api/cart/add', {
            product_id: product.id,
            quantity: 1
        }, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
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

onMounted(() => {
    fetchProducts();
    fetchCategories();
});

// Remove the deep watch that was causing multiple requests
// watch(filters, () => {
//     applyFilters();
// }, { deep: true });
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

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
</style>
