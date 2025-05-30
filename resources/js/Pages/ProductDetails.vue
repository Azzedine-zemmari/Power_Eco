<template>
<div class="bg-gray-50 text-gray-800 font-sans">
    <!-- Navigation -->
    <Navbar/>

    <!-- Breadcrumbs -->
    <nav class="bg-white py-3 px-4 sm:px-6 lg:px-8" aria-label="Breadcrumb">
        <ol class="max-w-7xl mx-auto flex items-center space-x-2 text-sm text-gray-500">
            <li>
                <a href="index.html" class="hover:text-gray-700">Home</a>
            </li>
            <li class="flex items-center">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
                <a href="products.html" class="ml-2 hover:text-gray-700">Products</a>
            </li>
            <li class="flex items-center">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
                <span class="ml-2 text-gray-900 font-medium">Premium Solar Panel Kit</span>
            </li>
        </ol>
    </nav>

    <!-- Product Detail -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-8">
                <!-- Product Image -->
                <div class="lg:max-w-lg lg:self-end">
                    <div class="rounded-lg overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1522107177-01884fcef41f?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Premium Solar Panel Kit" class="w-full h-full object-center object-cover">
                    </div>
                </div>

                <!-- Product Info -->
                <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">Premium Solar Panel Kit</h1>
                    

                    <!-- Price -->
                    <div class="mt-4">
                        <p class="text-3xl text-gray-900">$899</p>
                        <p class="mt-1 text-sm text-gray-500">Free shipping and returns</p>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <h2 class="text-sm font-medium text-gray-900">Description</h2>
                        <div class="mt-4 prose prose-sm text-gray-500">
                            <p>The Premium Solar Panel Kit is a complete home solar solution designed for easy installation and maximum energy efficiency. This kit includes high-efficiency monocrystalline solar panels, an inverter, mounting hardware, and a comprehensive installation guide.</p>
                            <p class="mt-2">Perfect for homeowners looking to reduce their carbon footprint and energy bills, this system can generate up to 5kW of clean, renewable energy. The panels are weather-resistant, durable, and come with a 25-year warranty.</p>
                        </div>
                    </div>


                    <!-- Quantity Selector -->
                    <div class="mt-8">
                        <div class="flex items-center">
                            <h2 class="text-sm font-medium text-gray-900 w-24">Quantity</h2>
                            <div class="flex items-center border border-gray-300 rounded-md">
                                <button type="button" class="p-2 text-gray-500 hover:text-gray-600">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <input type="text" class="w-12 text-center border-transparent focus:border-green-500 focus:ring-0" value="1">
                                <button type="button" class="p-2 text-gray-500 hover:text-gray-600">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Add to Cart Button -->
                    <div class="mt-8">
                        <button type="button" class="w-full bg-green-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
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
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Customers also purchased</h2>
                <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    <!-- Related Product 1 -->
                    <div class="group relative">
                        <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                            <img src="https://images.unsplash.com/photo-1564424224827-cd24b8915874?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1489&q=80" alt="Eco Smart Thermostat" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        Eco Smart Thermostat
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">Energy-saving temperature control</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">$199</p>
                        </div>
                    </div>

                    <!-- Related Product 2 -->
                    <div class="group relative">
                        <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                            <img src="https://images.unsplash.com/photo-1592833167665-45638961c288?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Energy Efficient LED Bulbs" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        Energy Efficient LED Bulbs
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">Pack of 6 smart LED bulbs</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">$49</p>
                        </div>
                    </div>

                    <!-- Related Product 3 -->
                    <div class="group relative">
                        <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                            <img src="https://images.unsplash.com/photo-1560343776-97e7d202ff0e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1051&q=80" alt="Portable Solar Charger" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        Portable Solar Charger
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">Compact solar panel for devices</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">$79</p>
                        </div>
                    </div>

                    <!-- Related Product 4 -->
                    <div class="group relative">
                        <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                            <img src="https://images.unsplash.com/photo-1592833167665-45638961c288?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Home Battery Storage" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        Home Battery Storage
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">Store excess solar energy</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">$1,299</p>
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

</script>