<template>
<div class="bg-gray-50 text-gray-800 font-sans">
    <div class="flex h-screen overflow-hidden">
        <Sidebar/>

        <!-- Main content -->
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <!-- Top header -->
            <div class="flex-shrink-0 flex h-16 bg-white shadow">
                <div class="flex-1 px-4 flex justify-between items-center">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-semibold text-gray-900">Welcome back, {{ user?.lastName || 'User' }}</h1>
                    </div>
                </div>
            </div>

            <main class="flex-1 relative overflow-y-auto focus:outline-none">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <!-- Dashboard content -->
                        <div class="py-4">
                            <!-- Stats -->
                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                                <!-- Total Products -->
                                <div class="bg-white overflow-hidden shadow rounded-lg transform transition duration-500 hover:scale-105">
                                    <div class="px-4 py-5 sm:p-6">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                </svg>
                                            </div>
                                            <div class="ml-5 w-0 flex-1">
                                                <dl>
                                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                                        Total Products
                                                    </dt>
                                                    <dd>
                                                        <div class="text-lg font-medium text-gray-900">
                                                            {{ stats.totalProducts }}
                                                        </div>
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                                        <div class="text-sm">
                                            <a href="/productManager/Products" class="font-medium text-green-600 hover:text-green-500 flex items-center">
                                                View all products
                                                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Categories -->
                                <div class="bg-white overflow-hidden shadow rounded-lg transform transition duration-500 hover:scale-105">
                                    <div class="px-4 py-5 sm:p-6">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                            </div>
                                            <div class="ml-5 w-0 flex-1">
                                                <dl>
                                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                                        Categories
                                                    </dt>
                                                    <dd>
                                                        <div class="text-lg font-medium text-gray-900">
                                                            {{ stats.totalCategories }}
                                                        </div>
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                                        <div class="text-sm">
                                            <a href="/productManager/Product/Category" class="font-medium text-green-600 hover:text-green-500 flex items-center">
                                                View all categories
                                                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Recent Sales -->
                                <div class="bg-white overflow-hidden shadow rounded-lg transform transition duration-500 hover:scale-105">
                                    <div class="px-4 py-5 sm:p-6">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div class="ml-5 w-0 flex-1">
                                                <dl>
                                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                                        Total Sales
                                                    </dt>
                                                    <dd>
                                                        <div class="text-lg font-medium text-gray-900">
                                                            MAD {{ stats.totalSales }}
                                                        </div>
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="bg-gray-50 px-4 py-4 sm:px-6">
                                        <div class="text-sm">
                                            <a href="/product-manager/sales" class="font-medium text-green-600 hover:text-green-500 flex items-center">
                                                View sales report
                                                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Sidebar from '../../components/Sidebar.vue';
import axios from 'axios';

const stats = ref({
    totalProducts: 0,
    totalCategories: 0,
    totalSales: 0
});

const user = ref(null);
const token = localStorage.getItem('token');

const fetchStats = async () => {
    try {
        const response = await axios.get('/api/product-manager/stats', {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        console.log('Stats Response:', response.data);
        stats.value = response.data;
    } catch (error) {
        console.error('Error fetching stats:', error.response?.data || error.message);
    }
};

async function fetchUserData() {
    try {
        const response = await axios.get('http://localhost:8000/api/user/data', {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });
        user.value = response.data;
        console.log("user data " , response.data)
    } catch (error) {
        console.error('Error fetching user data:', error);
    }
}

onMounted(() => {
    fetchStats();
    fetchUserData();
});
</script>