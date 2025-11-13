<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <!-- Navigation -->
        <Navbar />
        
        <!-- Page Header -->
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">{{ $t('cart.page_title') }}</h1>
            </div>
        </div>
        
        <!-- Cart Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start xl:gap-x-16">
                <!-- Cart Items -->
                <section aria-labelledby="cart-heading" class="lg:col-span-7">
                    <h2 id="cart-heading" class="sr-only">{{ $t('cart.heading') }}</h2>
                    
                    <!-- Loading Skeleton -->
                    <div v-if="loading">
                        <ul role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200">
                            <li v-for="n in 3" :key="n" class="py-6 flex animate-pulse">
                                <!-- Image Skeleton -->
                                <div class="flex-shrink-0">
                                    <div class="w-24 h-24 rounded-md bg-gray-200 sm:w-32 sm:h-32"></div>
                                </div>
                                <!-- Content Skeleton -->
                                <div class="ml-4 flex-1 flex flex-col sm:ml-6">
                                    <div>
                                        <div class="flex justify-between">
                                            <!-- Product name skeleton -->
                                            <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                                            <!-- Price skeleton -->
                                            <div class="h-4 bg-gray-200 rounded w-16 ml-4"></div>
                                        </div>
                                    </div>
                                    <div class="mt-4 flex-1 flex items-end justify-between">
                                        <div class="flex items-center space-x-2">
                                            <!-- Quantity label skeleton -->
                                            <div class="h-4 bg-gray-200 rounded w-16"></div>
                                            <!-- Quantity select skeleton -->
                                            <div class="h-8 bg-gray-200 rounded w-16"></div>
                                        </div>
                                        <!-- Remove button skeleton -->
                                        <div class="h-4 bg-gray-200 rounded w-12 ml-4"></div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Actual Cart Items -->
                    <ul v-else-if="items.length > 0" role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200">
                        <li v-for="item in items" :key="item.product_id" class="py-6 flex">
                            <div class="flex-shrink-0">
                                <img 
                                    :src="getImageUrl(item.product_image)" 
                                    :alt="item.product_name"
                                    class="w-24 h-24 rounded-md object-center object-cover sm:w-32 sm:h-32"
                                    @error="handleImageError"
                                    loading="lazy"
                                >
                            </div>
                            <div class="ml-4 flex-1 flex flex-col sm:ml-6">
                                <div>
                                    <div class="flex justify-between">
                                        <h4 class="text-sm">
                                            <a :href="`/product/${item.product_id}`"
                                                class="font-medium text-gray-700 hover:text-gray-800">{{
                                                item.product_name }}</a>
                                        </h4>
                                        <p class="ml-4 text-sm font-medium text-gray-900">{{ formatPrice(item.product_price) }} MAD</p>
                                    </div>
                                </div>
                                <div class="mt-4 flex-1 flex items-end justify-between">
                                    <div class="flex items-center space-x-2">
                                        <label :for="`quantity-${item.product_id}`" class="text-sm font-medium text-gray-700">
                                            {{ $t('cart.quantity') }}:
                                        </label>
                                        <select
                                            :id="`quantity-${item.product_id}`"
                                            :name="`quantity-${item.product_id}`"
                                            :value="item.quantity"
                                            @change="updateQuantity(item, $event.target.value)"
                                            :disabled="updatingQuantity === item.product_id"
                                            class="rounded-md border border-gray-300 text-base font-medium text-gray-700 text-left shadow-sm focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                                            <option v-for="q in 10" :key="q" :value="q">{{ q }}</option>
                                        </select>
                                        <!-- Loading indicator for quantity update -->
                                        <svg v-if="updatingQuantity === item.product_id" class="animate-spin h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </div>
                                    <button 
                                        @click="removeItem(item)" 
                                        type="button"
                                        :disabled="removingItem === item.product_id"
                                        class="ml-4 text-sm font-medium text-red-600 hover:text-red-500 disabled:opacity-50 disabled:cursor-not-allowed flex items-center">
                                        <svg v-if="removingItem === item.product_id" class="animate-spin h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span>{{ removingItem === item.product_id ? 'Removing...' : $t('cart.remove') }}</span>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                    
                    <!-- Empty Cart State -->
                    <div v-else-if="!loading" class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">{{ $t('cart.empty_title') }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $t('cart.empty_description') }}</p>
                        <div class="mt-6">
                            <a href="/products" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                {{ $t('cart.continue_shopping') }}
                            </a>
                        </div>
                    </div>
                </section>
                
                <!-- Order Summary -->
                <section v-if="!loading && items.length > 0" aria-labelledby="summary-heading"
                    class="mt-16 bg-white rounded-lg px-4 py-6 sm:p-6 lg:p-8 lg:mt-0 lg:col-span-5">
                    <h2 id="summary-heading" class="text-lg font-medium text-gray-900">{{ $t('cart.order_summary') }}</h2>
                    <dl class="mt-6 space-y-4">
                        <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                            <dt class="text-base font-medium text-gray-900">{{ $t('cart.order_total') }}</dt>
                            <dd class="text-base font-medium text-gray-900">{{ formatPrice(total) }} MAD</dd>
                        </div>
                    </dl>
                    <div class="mt-6">
                        <RouterLink :to="{name:'checkout'}"
                            class="w-full bg-green-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 flex items-center justify-center">
                            {{ $t('cart.proceed_to_checkout') }}
                        </RouterLink>
                    </div>
                    <div class="mt-6 text-sm text-center text-gray-500">
                        <p>
                            {{ $t('cart.or') }} <a href="/products" class="text-green-600 font-medium hover:text-green-500">{{ $t('cart.continue_shopping') }}<span aria-hidden="true"> &rarr;</span></a>
                        </p>
                    </div>
                    <!-- Eco-friendly message -->
                    <div class="mt-8 border-t border-gray-200 pt-6">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="ml-2 text-sm text-gray-500">
                                {{ $t('cart.eco_message') }}
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Order Summary Skeleton -->
                <section v-if="loading" aria-labelledby="summary-heading"
                    class="mt-16 bg-white rounded-lg px-4 py-6 sm:p-6 lg:p-8 lg:mt-0 lg:col-span-5 animate-pulse">
                    <!-- Title skeleton -->
                    <div class="h-6 bg-gray-200 rounded w-32"></div>
                    <div class="mt-6 space-y-4">
                        <!-- Total skeleton -->
                        <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                            <div class="h-5 bg-gray-200 rounded w-24"></div>
                            <div class="h-5 bg-gray-200 rounded w-20"></div>
                        </div>
                    </div>
                    <!-- Checkout button skeleton -->
                    <div class="mt-6">
                        <div class="w-full h-12 bg-gray-200 rounded-md"></div>
                    </div>
                    <!-- Continue shopping skeleton -->
                    <div class="mt-6 text-center">
                        <div class="h-4 bg-gray-200 rounded w-48 mx-auto"></div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<script setup>
import Navbar from '../components/Navbar.vue';
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import { useCartStore } from '../stores/CartStore';
import { useRouter } from 'vue-router';
import api from '../axios';
import { useAuthStore } from '../stores/AuthStore';

const items = ref([]);
const loading = ref(false);
const updatingQuantity = ref(null);
const removingItem = ref(null);
const cart = useCartStore();
const router = useRouter();

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
    if (!imagePath) return '/placeholder.svg?height=128&width=128';
    if (imagePath.startsWith('http')) return imagePath;
    return `https://powerEco.onrender.com/storage/${imagePath}`;
};

const handleImageError = (event) => {
    event.target.src = '/placeholder.svg?height=128&width=128';
};

// Computed properties for order summary
const total = computed(() => {
    return items.value.reduce((sum, item) => {
        return sum + (parseFloat(item.product_price) * parseInt(item.quantity));
    }, 0);
});

const cartItems = async () => {
    loading.value = true;
    try {
        const response = await api.get('/cart');
        
        items.value = response.data.cart_items || [];
    } catch (error) {
        console.error(error);
        alert('Failed to load cart');
    } finally {
        loading.value = false;
    }
};

const updateQuantity = async (item, newQuantity) => {
    const oldQuantity = item.quantity; // Store old quantity for rollback
    updatingQuantity.value = item.product_id;
    
    try {
        item.quantity = parseInt(newQuantity);
        
        await api.put(`/cart/${item.product_id}`, {
            quantity: parseInt(newQuantity)
        });
        
    } catch (error) {
        console.error(error);
        alert('Failed to update quantity');
        // Rollback the quantity on error
        item.quantity = oldQuantity;
    } finally {
        updatingQuantity.value = null;
    }
};

const removeItem = async (item) => {
    removingItem.value = item.product_id;
    
    try {
        await api.delete(`/cart/${item.id}/drop`);
        
        // Remove item from local state
        items.value = items.value.filter(cartItem => cartItem.product_id !== item.product_id);
        cart.cartCount -= 1;
    } catch (error) {
        console.error(error);
        alert('Failed to remove item');
    } finally {
        removingItem.value = null;
    }
};

onMounted(() => {
    const checkAuth = () => {
        if (!isAuthenticated.value) {
            router.push('/login');
        } else {
            cartItems();
        }
    };

    checkAuth();
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

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}
</style>
