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
                    <a href="/" class="hover:text-gray-700">Home</a>
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <a href="/products" class="ml-2 hover:text-gray-700">Products</a>
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span v-if="product" class="ml-2 text-gray-900 font-medium">{{ product.name }}</span>
                </li>
            </ol>
        </nav>

        <!-- Product Detail -->
        <div class="bg-white">
            <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
                <div v-if="product" class="lg:grid lg:grid-cols-2 lg:gap-x-8">
                    <!-- Product Image -->
                    <div class="lg:max-w-lg lg:self-end">
                        <div class="rounded-lg overflow-hidden">
                            <img :src="`/storage/${product.image}`" alt="Premium Solar Panel Kit" class="w-full h-full object-center object-cover">
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ product.name }}</h1>
                        

                        <!-- Price -->
                        <div class="mt-4">
                            <p class="text-3xl text-gray-900">MAD {{ product.price }}</p>
                            <p class="mt-1 text-sm text-gray-500">Free shipping and returns</p>
                        </div>

                        <!-- Description -->
                        <div class="mt-6">
                            <h2 class="text-sm font-medium text-gray-900">Description</h2>
                            <div class="mt-4 prose prose-sm text-gray-500">
                                <p>{{ product.description }}</p>
                            </div>
                        </div>


                        <!-- Quantity Selector -->
                        <div class="mt-8">
                            <div class="flex items-center">
                                <h2 class="text-sm font-medium text-gray-900 w-24">Quantity</h2>
                                <div class="flex items-center border border-gray-300 rounded-md">
                                    <button @click="decreaseQuantity" type="button" class="p-2 text-gray-500 hover:text-gray-600">
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <input v-model="quantity" type="text" class="w-12 text-center border-transparent focus:border-green-500 focus:ring-0">
                                    <button @click="increaseQuantity" type="button" class="p-2 text-gray-500 hover:text-gray-600">
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Add to Cart Button -->
                        <div class="mt-8">
                            <button @click="addToCart" type="button" class="w-full bg-green-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Add to Cart
                            </button>
                        </div>

                        <!-- Shipping Info -->
                        <div class="mt-8 border-t border-gray-200 pt-8">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-5h2.05a2.5 2.5 0 014.9 0H19a1 1 0 001-1v-4a1 1 0 00-1-1h-8a1 1 0 00-.8.4L8.4 8H5V5a1 1 0 00-1-1H3z" />
                                </svg>
                                <p class="ml-2 text-sm text-gray-500">Free shipping on orders over $500</p>
                            </div>
                            <div class="mt-2 flex items-center">
                                <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" />
                                </svg>
                                <p class="ml-2 text-sm text-gray-500">In stock and ready to ship</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Products -->
                <div class="mt-16 sm:mt-24">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Related Products</h2>
                    <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                        <div v-for="relatedProduct in relatedProducts" :key="relatedProduct.id" class="group relative">
                            <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                                <img :src="`/storage/${relatedProduct.image}`" :alt="relatedProduct.name" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                            </div>
                            <div class="mt-4 flex justify-between">
                                <div>
                                    <h3 class="text-sm text-gray-700">
                                        <a :href="`/product/${relatedProduct.id}`">
                                            <span aria-hidden="true" class="absolute inset-0"></span>
                                            {{ relatedProduct.name }}
                                        </a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">{{ relatedProduct.description }}</p>
                                </div>
                                <p class="text-sm font-medium text-gray-900">MAD {{ relatedProduct.price }}</p>
                            </div>
                        </div>
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

const product = ref(null);
const relatedProducts = ref([]);
const cart = useCartStore();
const route = useRoute();
const router = useRouter();
const productId = route.params.id;
const showNotification = ref(false);
const notificationMessage = ref('');

const isAuthenticated = computed(() => {
    return !!localStorage.getItem('token');
});

const fetchProduct = async () => {
    try {
        const token = localStorage.getItem('token');
        const response = await axios.get(`/api/product/${productId}`, {
            withCredentials: true,
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${token}`
            }
        });
        product.value = response.data.product;
        relatedProducts.value = response.data.relatedProducts;
        console.log(product.value);
    } catch (error) {
        console.error('Error fetching product: ', error);
    }
};

const quantity = ref(1);

watch(quantity, (newValue) => {
    const num = parseInt(newValue);
    if (isNaN(num) || num < 1) {
        quantity.value = 1;
    } else if (num > 10) {
        quantity.value = 10;
    }
});

const increaseQuantity = () => {
    if (quantity.value < 10) {
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
    try {
        await axios.post('/api/cart/add', {
            product_id: productId,
            quantity: quantity.value
        }, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        cart.cartCount += 1;
        notificationMessage.value = `${product.value.name} has been added to your cart.`;
        showNotification.value = true;
    } catch (error) {
        console.error(error);
    }
};

onMounted(fetchProduct);
</script>