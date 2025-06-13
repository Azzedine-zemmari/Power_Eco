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
                                        <span class="block">Sustainable Solutions</span>
                                        <span class="block text-green-600">for a Greener Future</span>
                                    </h1>
                                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                                        Discover our range of eco-friendly products designed to reduce your carbon footprint and promote sustainable living.
                                    </p>
                                    <div class="mt-8 sm:mt-12">
                                        <a href="products.html" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            Shop Now
                                        </a>
                                        <a href="about.html" class="ml-4 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            Learn More
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
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1497440001374-f26997328c1b?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Solar panels on a green field">
        </div>
    </div>


    <!-- Featured Products -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto py-16 sm:py-24 lg:py-32 lg:max-w-none">
                <h2 class="text-3xl font-extrabold text-gray-900">Featured Products</h2>
                <div class="mt-6 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-4 lg:gap-x-6">
                    <!-- Product Card -->
                    <div v-for="product in featuredProducts" :key="product.id" class="group relative">
                        <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                            <img :src="`/storage/${product.image}`" :alt="product.name" class="w-full h-full object-center object-cover">
                        </div>
                        <h3 class="mt-6 text-sm text-gray-500">
                            <a :href="`product/${product.id}`">
                                <span class="absolute inset-0"></span>
                                {{ product.name }}
                            </a>
                        </h3>
                        <p class="text-base font-semibold text-gray-900">${{ product.sell_price }}</p>
                        <p class="mt-1 text-sm text-gray-500">Stock: {{ product.stock }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sustainability Section -->
    <div class="bg-green-700">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">Ready to go green?</span>
                <span class="block text-green-200">Start your sustainable journey today.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="products.html" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-green-600 bg-white hover:bg-green-50">
                        Shop Products
                    </a>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="about.html" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                        Learn More
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

const featuredProducts = ref([]);

const fetchFeaturedProducts = async () => {
    try {
        const response = await axios.get('http://localhost:8000/api/featured-products');
        featuredProducts.value = response.data;
    } catch (error) {
        console.error('Error fetching featured products:', error);
    }
};

onMounted(() => {
    fetchFeaturedProducts();
});
</script>