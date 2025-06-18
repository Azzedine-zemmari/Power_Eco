<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <div class="flex h-screen overflow-hidden">
            <CommercialSideBar />

            <!-- Main content -->
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <!-- Top header -->
                <div class="flex-shrink-0 flex h-16 bg-white shadow">
                    <div class="flex-1 px-4 flex justify-between">
                        <div class="flex-1 flex">
                            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900 self-center">Sales List</h1>
                        </div>
                    </div>
                </div>

                <!-- Main content area -->
                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">Welcome back, {{ user?.firstName }}</h1>
                        </div>
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <!-- Dashboard content -->
                            <div class="py-4">
                                <!-- Sales Table -->
                                <div class="mt-6">
                                    <h2 class="text-lg font-semibold mb-2">Sales Orders</h2>
                                    <div class="overflow-x-auto">
                                         <table class="min-w-full bg-white rounded shadow">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Order ID</th>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        User</th>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Tel</th>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Email</th>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Status</th>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Products</th>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Total Price</th>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr v-for="item in sale" :key="item.orderId" class="hover:bg-gray-50">
                                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        #{{ item.orderId }}
                                                    </td>
                                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                                        {{ item.lastname }} {{ item.firstname }}
                                                    </td>
                                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                                        {{ item.phone }}
                                                    </td>
                                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                                        {{ item.email }}
                                                    </td>
                                                    <td class="px-4 py-4 whitespace-nowrap">
                                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full"
                                                            :class="{
                                                                'bg-yellow-100 text-yellow-800': item.status === 'order',
                                                                'bg-blue-100 text-blue-800': item.status === 'paid',
                                                                'bg-green-100 text-green-800': item.status === 'delivered',
                                                                'bg-purple-100 text-purple-800': item.status === 'received'
                                                            }">
                                                            {{ item.status.charAt(0).toUpperCase() + item.status.slice(1) }}
                                                        </span>
                                                    </td>
                                                    <td class="px-4 py-4 text-sm text-gray-900">
                                                        <div class="space-y-1">
                                                            <div v-for="p in item.products" :key="p.productId" class="text-xs">
                                                                <span class="font-medium">ID:</span> {{ p.productId }} | 
                                                                <span class="font-medium">Qty:</span> {{ p.quantity }} | 
                                                                <span class="font-medium">Price:</span> MAD {{ p.price }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        MAD {{ item.totalPrice }}
                                                    </td>
                                                    <td class="px-4 py-4 whitespace-nowrap">
                                                        <select 
                                                            v-model="item.status" 
                                                            @change="updateSale(item)"
                                                            class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white hover:border-gray-400 transition-colors duration-200"
                                                            :class="{
                                                                'border-yellow-300 bg-yellow-50': item.status === 'ordered',
                                                                'border-blue-300 bg-blue-50': item.status === 'paid',
                                                                'border-green-300 bg-green-50': item.status === 'delivered',
                                                                'border-purple-300 bg-purple-50': item.status === 'received'
                                                            }">
                                                            <option value="ordered">📋 Ordered</option>
                                                            <option value="paid">💳 Paid</option>
                                                            <option value="delivered">🚚 Delivered</option>
                                                            <option value="received">✅ Received</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Pagination -->
                                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                                    <div class="flex-1 flex justify-between sm:hidden">
                                        <button 
                                            @click="currentPage > 1 && (currentPage--)"
                                            :disabled="currentPage === 1"
                                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                            :class="{ 'opacity-50 cursor-not-allowed': currentPage === 1 }"
                                        >
                                            Previous
                                        </button>
                                        <button 
                                            @click="currentPage < totalPages && (currentPage++)"
                                            :disabled="currentPage === totalPages"
                                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                            :class="{ 'opacity-50 cursor-not-allowed': currentPage === totalPages }"
                                        >
                                            Next
                                        </button>
                                    </div>
                                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm text-gray-700">
                                                Showing
                                                <span class="font-medium">{{ paginationStart }}</span>
                                                to
                                                <span class="font-medium">{{ paginationEnd }}</span>
                                                of
                                                <span class="font-medium">{{ totalItems }}</span>
                                                results
                                            </p>
                                        </div>
                                        <div>
                                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                                <button 
                                                    @click="currentPage > 1 && (currentPage--)"
                                                    :disabled="currentPage === 1"
                                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                                                    :class="{ 'opacity-50 cursor-not-allowed': currentPage === 1 }"
                                                >
                                                    <span class="sr-only">Previous</span>
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                <template v-for="page in displayedPages" :key="page">
                                                    <button 
                                                        v-if="page !== '...'"
                                                        @click="currentPage = page"
                                                        :class="[
                                                            currentPage === page 
                                                                ? 'z-10 bg-green-50 border-green-500 text-green-600' 
                                                                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                                                            'relative inline-flex items-center px-4 py-2 border text-sm font-medium'
                                                        ]"
                                                    >
                                                        {{ page }}
                                                    </button>
                                                    <span 
                                                        v-else 
                                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700"
                                                    >
                                                        ...
                                                    </span>
                                                </template>
                                                <button 
                                                    @click="currentPage < totalPages && (currentPage++)"
                                                    :disabled="currentPage === totalPages"
                                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                                                    :class="{ 'opacity-50 cursor-not-allowed': currentPage === totalPages }"
                                                >
                                                    <span class="sr-only">Next</span>
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </nav>
                                        </div>
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
import CommercialSideBar from '../../components/CommercialSideBar.vue';
import { onMounted, ref, computed, watch } from 'vue';
import axios from 'axios';

let sale = ref([]);
const user = ref(null);
const token = localStorage.getItem('token');
const currentPage = ref(1);
const itemsPerPage = 10;
const totalItems = ref(0);

const totalPages = computed(() => Math.ceil(totalItems.value / itemsPerPage));

const paginationStart = computed(() => {
    return ((currentPage.value - 1) * itemsPerPage) + 1;
});

const paginationEnd = computed(() => {
    return Math.min(currentPage.value * itemsPerPage, totalItems.value);
});

const displayedPages = computed(() => {
    const pages = [];
    const maxVisiblePages = 5;
    
    if (totalPages.value <= maxVisiblePages) {
        for (let i = 1; i <= totalPages.value; i++) {
            pages.push(i);
        }
    } else {
        if (currentPage.value <= 3) {
            for (let i = 1; i <= 4; i++) {
                pages.push(i);
            }
            pages.push('...');
            pages.push(totalPages.value);
        } else if (currentPage.value >= totalPages.value - 2) {
            pages.push(1);
            pages.push('...');
            for (let i = totalPages.value - 3; i <= totalPages.value; i++) {
                pages.push(i);
            }
        } else {
            pages.push(1);
            pages.push('...');
            for (let i = currentPage.value - 1; i <= currentPage.value + 1; i++) {
                pages.push(i);
            }
            pages.push('...');
            pages.push(totalPages.value);
        }
    }
    
    return pages;
});

const sales = async () => {
    try {
        const response = await axios.get(`http://localhost:8000/api/sales/data?page=${currentPage.value}&per_page=${itemsPerPage}`, {
            withCredentials: true,
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${token}`
            }
        });

        sale.value = response.data.data;
        totalItems.value = response.data.total;
    } catch (error) {
        console.log('error', error);
    }
};

const updateSale = async (item) => {
    try {
        await axios.put(`http://localhost:8000/api/sales/${item.orderId}`, {
            status: item.status
        }, {
            headers: {
                'Authoriz0ation': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });
        await sales(); 
    } catch (error) {
        console.error('Error updating sale:', error);
    }
};

const fetchUserData = async () => {
    try {
        const token = localStorage.getItem('token');
        console.log('Token:', token); // Log the token to verify it exists

        const response = await axios.get('http://localhost:8000/api/user/data', {
            withCredentials: true,
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });
        user.value = response.data;
        console.log('User data:', user.value);
    } catch (error) {
        console.error('Error fetching user data:', error.response?.data || error.message);
        console.error('Status:', error.response?.status);
        console.error('Headers sent:', error.config?.headers);
    }
};

watch(currentPage, () => {
    sales();
});

onMounted(() => {
    sales();
    fetchUserData();
});
</script>