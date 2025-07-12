<template>
    <Notification 
      :show="showNotification"
      title="Success!"
      :message="notificationMessage"
     @close="showNotification = false"
    />
    <div class="bg-gray-50 text-gray-800 font-sans">
        <!-- Navigation -->
        <Navbar/>
        
        <!-- Breadcrumbs -->
        <nav class="bg-white py-3 px-4 sm:px-6 lg:px-8" aria-label="Breadcrumb">
            <ol class="max-w-7xl mx-auto flex items-center space-x-2 text-sm text-gray-500">
                <li>
                    <RouterLink :to="{name:'Home'}" class="hover:text-gray-700">{{ $t('product_detail.breadcrumb.home') }}</RouterLink>
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <RouterLink :to="{name:'Userproducts'}" class="ml-2 hover:text-gray-700">{{ $t('product_detail.breadcrumb.products') }}</RouterLink>
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <!-- Breadcrumb Product Name Skeleton -->
                    <div v-if="loading" class="ml-2 h-4 bg-gray-200 rounded w-32 animate-pulse"></div>
                    <span v-else-if="product" class="ml-2 text-gray-900 font-medium">{{ product.name }}</span>
                </li>
            </ol>
        </nav>
        
        <!-- Product Detail -->
        <div class="bg-white">
            <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <!-- Loading Skeleton -->
        <div v-if="loading" class="lg:grid lg:grid-cols-2 lg:gap-x-8">
            <!-- Product Image Skeleton -->
            <div class="lg:max-w-lg lg:self-end">
                <div class="rounded-lg overflow-hidden">
                    <div class="w-full h-96 bg-gray-200 animate-pulse"></div>
                </div>
            </div>
            
            <!-- Product Info Skeleton -->
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                <!-- Title Skeleton -->
                <div class="space-y-3">
                    <div class="h-8 bg-gray-200 rounded w-3/4 animate-pulse"></div>
                    <div class="h-6 bg-gray-200 rounded w-1/2 animate-pulse"></div>
                </div>
                
                <!-- Price Skeleton -->
                <div class="mt-4 space-y-2">
                    <div class="h-8 bg-gray-200 rounded w-32 animate-pulse"></div>
                    <div class="h-4 bg-gray-200 rounded w-48 animate-pulse"></div>
                </div>
                
                <!-- Description Skeleton -->
                <div class="mt-6">
                    <div class="h-5 bg-gray-200 rounded w-24 animate-pulse mb-4"></div>
                    <div class="space-y-2">
                        <div class="h-4 bg-gray-200 rounded w-full animate-pulse"></div>
                        <div class="h-4 bg-gray-200 rounded w-5/6 animate-pulse"></div>
                        <div class="h-4 bg-gray-200 rounded w-4/5 animate-pulse"></div>
                        <div class="h-4 bg-gray-200 rounded w-3/4 animate-pulse"></div>
                    </div>
                </div>
                
                <!-- Quantity Selector Skeleton -->
                <div class="mt-8">
                    <div class="flex items-center space-x-4">
                        <div class="h-5 bg-gray-200 rounded w-16 animate-pulse"></div>
                        <div class="h-10 bg-gray-200 rounded w-32 animate-pulse"></div>
                    </div>
                </div>
                
                <!-- Add to Cart Button Skeleton -->
                <div class="mt-8">
                    <div class="w-full h-12 bg-gray-200 rounded-md animate-pulse"></div>
                </div>
                
                <!-- Shipping Info Skeleton -->
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <div class="space-y-3">
                        <div class="flex items-center space-x-2">
                            <div class="h-5 w-5 bg-gray-200 rounded animate-pulse"></div>
                            <div class="h-4 bg-gray-200 rounded w-40 animate-pulse"></div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="h-5 w-5 bg-gray-200 rounded animate-pulse"></div>
                            <div class="h-4 bg-gray-200 rounded w-32 animate-pulse"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Actual Product Content -->
        <div v-else-if="product" class="lg:grid lg:grid-cols-2 lg:gap-x-8">
            <!-- Product Image -->
            <div class="lg:max-w-lg lg:self-end">
                <div class="rounded-lg overflow-hidden">
                    <img 
                        :src="getImageUrl(product.image)" 
                        :alt="product.name" 
                        class="w-full h-full object-center object-cover"
                        @error="handleImageError"
                        loading="lazy"
                    >
                </div>
            </div>
            
            <!-- Product Info -->
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ product.name }}</h1>
                
                <!-- Price -->
                <div class="mt-4">
                    <div class="flex items-center space-x-2">
                        <p class="text-3xl text-gray-900">{{ formatPrice(product.sell_price ) }} MAD</p>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">{{ $t('product_detail.price_free_shipping') }}</p>
                </div>
                
                <!-- Stock Status -->
                <div class="mt-4">
                    <div class="flex items-center">
                        <div class="flex items-center">
                            <svg v-if="product.stock > 0" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <svg v-else class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span :class="product.stock > 0 ? 'text-green-600' : 'text-red-600'" class="ml-2 text-sm font-medium">
                                {{ product.stock > 0 ? `${product.stock} in stock` : $t('product_detail.out_of_stock') }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Description -->
                <div class="mt-6">
                    <h2 class="text-sm font-medium text-gray-900">{{ $t('product_detail.description') }}</h2>
                    <div class="mt-4 prose prose-sm text-gray-500">
                        <p>{{ product.description }}</p>
                    </div>
                </div>
                
                <!-- Quantity Selector -->
                <div class="mt-8" v-if="product.stock > 0">
                    <div class="flex items-center">
                        <h2 class="text-sm font-medium text-gray-900 w-24">{{ $t('product_detail.quantity') }}</h2>
                        <div class="flex items-center border border-gray-300 rounded-md">
                            <button @click="decreaseQuantity" type="button" class="p-2 text-gray-500 hover:text-gray-600 disabled:opacity-50" :disabled="quantity <= 1">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <input v-model="quantity" type="text" class="w-12 text-center border-transparent focus:border-green-500 focus:ring-0" :max="product.stock">
                            <button @click="increaseQuantity" type="button" class="p-2 text-gray-500 hover:text-gray-600 disabled:opacity-50" :disabled="quantity >= product.stock">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Add to Cart Button -->
                <div class="mt-8">
                    <button 
                        @click="addToCart" 
                        type="button" 
                        :disabled="addingToCart || product.stock === 0"
                        class="w-full border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed"
                        :class="product.stock > 0 ? 'bg-green-600 hover:bg-green-700' : 'bg-gray-400'"
                    >
                        <svg v-if="addingToCart" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ addingToCart ? 'Adding...' : (product.stock > 0 ? $t('product_detail.add_to_cart') : $t('product_detail.out_of_stock')) }}
                    </button>
                </div>
                
                <!-- Shipping Info -->
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-5h2.05a2.5 2.5 0 014.9 0H19a1 1 0 001-1v-4a1 1 0 00-1-1h-8a1 1 0 00-.8.4L8.4 8H5V5a1 1 0 00-1-1H3z" />
                        </svg>
                        <p class="ml-2 text-sm text-gray-500">{{ $t('product_detail.shipping_info.free_shipping') }}</p>
                    </div>
                    <div class="mt-2 flex items-center">
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" />
                        </svg>
                        <p class="ml-2 text-sm text-gray-500">{{ $t('product_detail.shipping_info.in_stock') }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Error State -->
        <div v-else-if="error" class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Product not found</h3>
            <p class="mt-1 text-sm text-gray-500">{{ error }}</p>
            <div class="mt-6">
                <button @click="fetchProduct" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                    Try Again
                </button>
            </div>
        </div>
        
        <!-- Related Products -->
        <div class="mt-16 sm:mt-24">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">{{ $t('product_detail.related_products') }}</h2>
            
            <!-- Related Products Loading Skeleton -->
            <div v-if="loading" class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                <div v-for="n in 4" :key="n" class="group relative animate-pulse">
                    <!-- Image Skeleton -->
                    <div class="w-full h-80 bg-gray-200 rounded-md"></div>
                    <!-- Content Skeleton -->
                    <div class="mt-4 space-y-2">
                        <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                        <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                        <div class="h-5 bg-gray-200 rounded w-16"></div>
                    </div>
                </div>
            </div>
            
            <!-- Actual Related Products -->
            <div v-else-if="relatedProducts.length > 0" class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                <div v-for="relatedProduct in relatedProducts" :key="relatedProduct.id" class="group relative hover:shadow-lg transition-shadow duration-200">
                    <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                        <img 
                            :src="getImageUrl(relatedProduct.image)" 
                            :alt="relatedProduct.name" 
                            class="w-full h-full object-center object-cover lg:w-full lg:h-full"
                            @error="handleImageError"
                            loading="lazy"
                        >
                    </div>
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700">
                                <a :href="`/product/${relatedProduct.id}`">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ relatedProduct.name }}
                                </a>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500 line-clamp-2">{{ relatedProduct.description }}</p>
                        </div>
                        <p class="text-sm font-medium text-gray-900">{{ formatPrice(relatedProduct.sell_price || relatedProduct.price) }} MAD</p>
                    </div>
                </div>
            </div>
            
            <!-- No Related Products -->
            <div v-else-if="!loading" class="mt-6 text-center py-8">
                <p class="text-gray-500">No related products found.</p>
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
import { useCartStore } from '../stores/CartStore';
import { useRoute } from 'vue-router';
import { onMounted, ref, computed, watch } from 'vue';
import { useRouter } from 'vue-router';
import Notification from '../components/Notification.vue';
import { useI18n } from 'vue-i18n';
import { useAuthStore } from '../stores/AuthStore';

const product = ref(null);
const relatedProducts = ref([]);
const loading = ref(false);
const error = ref('');
const addingToCart = ref(false);
const cart = useCartStore();
const route = useRoute();
const router = useRouter();
const productId = route.params.id;
const showNotification = ref(false);
const notificationMessage = ref('');
const { t } = useI18n();
import api from '../axios';

const auth = useAuthStore();

const isAuthenticated = computed(() => auth.isAuthenticated);

// Utility functions
const formatPrice = (price) => {
    const numPrice = parseFloat(price) || 0;
    return new Intl.NumberFormat('fr-FR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(numPrice);
};

const getImageUrl = (imagePath) => {
    if (!imagePath) return '/placeholder.svg?height=400&width=400';
    if (imagePath.startsWith('http')) return imagePath;
    return `http://localhost:8000/storage/${imagePath}`;
};

const handleImageError = (event) => {
    event.target.src = '/placeholder.svg?height=400&width=400';
};

const fetchProduct = async () => {
    loading.value = true;
    error.value = '';
    
    try {
        // const token = localStorage.getItem('token');
        const response = await api.get(`/product/${productId}`);
        
        product.value = response.data.product;
        relatedProducts.value = response.data.relatedProducts || [];
    } catch (err) {
        console.error('Error fetching product:', err);
        if (err.response?.status === 404) {
            error.value = 'Product not found';
        } else if (err.response?.status === 401) {
            error.value = 'Please log in to view this product';
        } else {
            error.value = 'Failed to load product. Please try again.';
        }
    } finally {
        loading.value = false;
    }
};

const quantity = ref(1);

watch(quantity, (newValue) => {
    const num = parseInt(newValue);
    if (isNaN(num) || num < 1) {
        quantity.value = 1;
    } else if (product.value && num > product.value.stock) {
        quantity.value = product.value.stock;
    } else if (num > 10) {
        quantity.value = 10;
    }
});

const increaseQuantity = () => {
    const maxQuantity = product.value ? Math.min(product.value.stock, 10) : 10;
    if (quantity.value < maxQuantity) {
        quantity.value++;
    }
};

const decreaseQuantity = () => {
    if (quantity.value > 1) {
        quantity.value--;
    }
};

const addToCart = async () => {
    if (!isAuthenticated.value) {
        router.push(`/login?redirect=${route.fullPath}`);
        return;
    }
    
    if (product.value.stock === 0) {
        return;
    }
    
    addingToCart.value = true;
    
    try {
        await api.post('/cart/add', {
            product_id: productId,
            quantity: quantity.value
        });
        
        cart.cartCount += 1;
        notificationMessage.value = t('cart.added_message', {
            product: product.value.name
        });
        showNotification.value = true;
        
        // Reset quantity after successful add
        quantity.value = 1;
    } catch (error) {
        console.error('Error adding to cart:', error);
        // You could show an error notification here
    } finally {
        addingToCart.value = false;
    }
};

onMounted(fetchProduct);
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

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

.line-through {
    text-decoration: line-through;
}
</style>
