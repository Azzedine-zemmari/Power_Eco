<template>
<div class="bg-gray-50 text-gray-800 font-sans">
    <Navbar/>

    <!-- Page Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Products</h1>
        </div>
    </div>

    <!-- Product Listing with Sidebar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row py-6">
            <!-- Sidebar / Filters -->
            <!-- <div class="w-full md:w-64 mb-6 md:mb-0 md:mr-8">
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="font-bold text-lg mb-4">Filters</h2> -->
                    
                    <!-- Search -->
                    <!-- <div class="mb-6">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="text" name="search" id="search" class="focus:ring-green-500 focus:border-green-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md" placeholder="Search products...">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div> -->
                    
                    <!-- Categories -->
                    <!-- <div class="mb-6">
                        <h3 class="font-medium text-sm text-gray-900 mb-2">Categories</h3>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input id="category-solar" name="category" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <label for="category-solar" class="ml-2 text-sm text-gray-700">Solar Panels</label>
                            </div>
                            <div class="flex items-center">
                                <input id="category-bikes" name="category" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <label for="category-bikes" class="ml-2 text-sm text-gray-700">Electric Bikes</label>
                            </div>
                            <div class="flex items-center">
                                <input id="category-gadgets" name="category" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <label for="category-gadgets" class="ml-2 text-sm text-gray-700">Eco Gadgets</label>
                            </div>
                            <div class="flex items-center">
                                <input id="category-home" name="category" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <label for="category-home" class="ml-2 text-sm text-gray-700">Home Energy</label>
                            </div>
                        </div>
                    </div> -->
                    
                    <!-- Price Range -->
                    <!-- <div class="mb-6">
                        <h3 class="font-medium text-sm text-gray-900 mb-2">Price Range</h3>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input id="price-1" name="price" type="radio" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300">
                                <label for="price-1" class="ml-2 text-sm text-gray-700">Under $100</label>
                            </div>
                            <div class="flex items-center">
                                <input id="price-2" name="price" type="radio" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300">
                                <label for="price-2" class="ml-2 text-sm text-gray-700">$100 - $500</label>
                            </div>
                            <div class="flex items-center">
                                <input id="price-3" name="price" type="radio" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300">
                                <label for="price-3" class="ml-2 text-sm text-gray-700">$500 - $1000</label>
                            </div>
                            <div class="flex items-center">
                                <input id="price-4" name="price" type="radio" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300">
                                <label for="price-4" class="ml-2 text-sm text-gray-700">Over $1000</label>
                            </div>
                        </div>
                    </div> -->
                    
                    <!-- Brand -->
                    <!-- <div class="mb-6">
                        <h3 class="font-medium text-sm text-gray-900 mb-2">Brand</h3>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input id="brand-1" name="brand" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <label for="brand-1" class="ml-2 text-sm text-gray-700">EcoSolar</label>
                            </div>
                            <div class="flex items-center">
                                <input id="brand-2" name="brand" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <label for="brand-2" class="ml-2 text-sm text-gray-700">GreenRide</label>
                            </div>
                            <div class="flex items-center">
                                <input id="brand-3" name="brand" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <label for="brand-3" class="ml-2 text-sm text-gray-700">EcoTech</label>
                            </div>
                            <div class="flex items-center">
                                <input id="brand-4" name="brand" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <label for="brand-4" class="ml-2 text-sm text-gray-700">SustainLife</label>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" class="w-full bg-green-600 border border-transparent rounded-md shadow-sm py-2 px-4 text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Apply Filters
                    </button>
                </div>
            </div> -->
            
            <!-- Product Grid -->
            <div class="flex-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Product 1 -->
                    <div v-for="product in products" class="bg-white rounded-lg shadow overflow-hidden">
                        <a href="">
                            <img class="w-full h-48 object-cover" :src="`/storage/${product.image}`" alt="Premium Solar Panel Kit">
                        </a>
                        <div class="p-4">
                            <a href="product-detail.html">
                                <h3 class="text-lg font-semibold text-gray-900">{{ product.name }}</h3>
                            </a>
                            <p class="mt-1 text-sm text-gray-500">{{ product.description }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <p class="text-lg font-bold text-gray-900">{{ product.price }} MAD</p>
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-6">
                    
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
import { onMounted, ref } from 'vue';
let products = ref('')
let error = ref(null)
let loading = ref(true)
const token = localStorage.getItem('token')

async function fetchProducts() {
    try{
        const response = await axios.get('http://localhost:8000/api/products',{
            withCredentials:true,
            headers:{
                Accept:'application/json',
                Authorization: `Bearer ${token}`
            }
        })
        products.value = response.data
        console.log(products.value)
    }catch(error){
        error.value = 'Failed to load products'
        console.error(error)
    }finally{
        loading.value = false
    }
}
onMounted(()=>{
    fetchProducts()
})
</script>