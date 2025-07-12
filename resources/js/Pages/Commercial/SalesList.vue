<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <div class="flex h-screen overflow-hidden">
            <CommercialSideBar />

            <!-- Main content -->
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <!-- Top header -->
                <div class="flex-shrink-0 flex h-16 bg-white shadow">
                    <div class="flex-1 px-4 flex gap-2 items-center">
                        <div class="flex">
                            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900 self-center">Sales List</h1>
                        </div>
                        
                        <!-- CSV Download button -->
                        <button @click.prevent="downloadCSV" :disabled="loading || sale.length === 0"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Download CSV
                        </button>

                        <!-- Refresh button -->
                        <button @click.prevent="refreshData" :disabled="loading"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50">
                            <svg :class="loading ? 'animate-spin' : ''" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            {{ loading ? 'Refreshing...' : 'Refresh' }}
                        </button>
                    </div>
                </div>

                <!-- Main content area -->
                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">
                                Welcome back, {{ user?.firstName || user?.firstname || 'User' }}
                            </h1>
                        </div>
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <!-- Dashboard content -->
                            <div class="py-4">
                                <!-- Success message -->
                                <div v-if="successMessage"
                                    class="bg-green-50 border border-green-200 rounded-md p-4 mb-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-green-800">{{ successMessage }}</p>
                                        </div>
                                        <div class="ml-auto pl-3">
                                            <button @click="successMessage = ''"
                                                class="inline-flex text-green-400 hover:text-green-500">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Loading state -->
                                <div v-if="loading" class="text-center py-8">
                                    <div
                                        class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-green-600">
                                    </div>
                                    <p class="mt-2 text-gray-600">Loading sales data...</p>
                                </div>

                                <!-- Error state -->
                                <div v-else-if="error" class="bg-red-50 border border-red-200 rounded-md p-4 mb-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-red-800">Error loading sales data</h3>
                                            <div class="mt-2 text-sm text-red-700">
                                                <p>{{ error }}</p>
                                            </div>
                                            <div class="mt-4">
                                                                                            <button @click.prevent="refreshData"
                                                class="bg-red-100 px-3 py-2 rounded-md text-sm font-medium text-red-800 hover:bg-red-200">
                                                Try Again
                                            </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sales Table -->
                                <div v-else-if="sale.length > 0" class="mt-6">
                                    <div class="flex justify-between items-center mb-4">
                                        <h2 class="text-lg font-semibold">Sales Orders ({{ totalItems }} orders)</h2>
                                    </div>

                                    <div class="overflow-x-auto shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                        <table class="min-w-full bg-white">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Order ID</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Customer</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Contact</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Status</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Products</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Total Price</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Date</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr v-for="item in sale" :key="item.orderId || item.id"
                                                    class="hover:bg-gray-50 transition-colors duration-150">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        #{{ item.orderId || item.id }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ item.lastname || item.last_name }} {{ item.firstname ||
                                                            item.first_name }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ item.email }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                        <div>{{ item.phone }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span
                                                            class="inline-flex px-2 py-1 text-xs font-semibold rounded-full"
                                                            :class="getStatusClass(item.status)">
                                                            {{ formatStatus(item.status) }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 text-sm text-gray-900">
                                                        <div class="max-w-xs">
                                                            <div v-if="item.products && item.products.length > 0"
                                                                class="space-y-1">
                                                                <div v-for="(p, index) in item.products" :key="index"
                                                                    class="text-xs bg-gray-50 p-1.5 rounded">
                                                                    <div class="font-medium text-xs">{{ p.name ||
                                                                        `Product ID: ${p.productId || p.product_id}` }}
                                                                    </div>
                                                                    <div class="text-gray-600 text-xs">
                                                                        Qty: {{ p.quantity }} × {{ formatPrice(p.price)
                                                                        }} MAD
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div v-else class="text-xs text-gray-500">No products</div>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        {{ formatPrice(item.totalPrice || item.total_price) }} MAD
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ formatDate(item.created_at || item.createdAt) }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <select v-model="item.status" @change="updateSale(item)"
                                                            :disabled="updatingStatus === (item.orderId || item.id)"
                                                            class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white hover:border-gray-400 transition-colors duration-200 disabled:opacity-50"
                                                            :class="getStatusSelectClass(item.status)">
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

                                <!-- No data state -->
                                <div v-else class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No sales orders</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ statusFilter ? `No orders found with status "${statusFilter}"` : 'No sales orders found for the current period.' }}
                                    </p>
                                    <div class="mt-6">
                                        <button @click.prevent="refreshData"
                                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            Refresh Data
                                        </button>
                                    </div>
                                </div>

                                <!-- Pagination -->
                                <div v-if="totalPages > 1"
                                    class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-6 rounded-lg shadow">
                                    <div class="flex-1 flex justify-between sm:hidden">
                                        <button @click="currentPage > 1 && (currentPage--)"
                                            :disabled="currentPage === 1"
                                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                            Previous
                                        </button>
                                        <button @click="currentPage < totalPages && (currentPage++)"
                                            :disabled="currentPage === totalPages"
                                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
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
                                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                                aria-label="Pagination">
                                                <button @click="currentPage > 1 && (currentPage--)"
                                                    :disabled="currentPage === 1"
                                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                                    <span class="sr-only">Previous</span>
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                <template v-for="page in displayedPages" :key="page">
                                                    <button v-if="page !== '...'" @click="currentPage = page" :class="[
                                                        currentPage === page
                                                            ? 'z-10 bg-green-50 border-green-500 text-green-600'
                                                            : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                                                        'relative inline-flex items-center px-4 py-2 border text-sm font-medium'
                                                    ]">
                                                        {{ page }}
                                                    </button>
                                                    <span v-else
                                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                                        ...
                                                    </span>
                                                </template>
                                                <button @click="currentPage < totalPages && (currentPage++)"
                                                    :disabled="currentPage === totalPages"
                                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                                    <span class="sr-only">Next</span>
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/xmlns=http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                            clip-rule="evenodd" />
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
import api from '../../axios';
import { useAuthStore } from '../../stores/AuthStore';

// State variables
const sale = ref([]);
const user = ref(null);
const auth = useAuthStore();
const currentPage = ref(1);
const itemsPerPage = 10;
const totalItems = ref(0);
const loading = ref(false);
const error = ref(null);
const successMessage = ref('');
const statusFilter = ref('');
const updatingStatus = ref(null);

// API configuration - using api instance instead

// Computed properties
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

// Utility functions
function formatPrice(price) {
    const numPrice = parseFloat(price) || 0;
    return new Intl.NumberFormat('fr-FR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(numPrice);
}

function formatDate(dateString) {
    if (!dateString) return 'N/A';
    try {
        return new Date(dateString).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    } catch (error) {
        return 'Invalid Date';
    }
}

function formatStatus(status) {
    if (!status) return 'Unknown';
    return status.charAt(0).toUpperCase() + status.slice(1);
}

function getStatusClass(status) {
    const classes = {
        'ordered': 'bg-yellow-100 text-yellow-800',
        'order': 'bg-yellow-100 text-yellow-800',
        'paid': 'bg-blue-100 text-blue-800',
        'delivered': 'bg-green-100 text-green-800',
        'received': 'bg-purple-100 text-purple-800'
    };
    return classes[status] || 'bg-gray-100 text-gray-800';
}

function getStatusSelectClass(status) {
    const classes = {
        'ordered': 'border-yellow-300 bg-yellow-50',
        'order': 'border-yellow-300 bg-yellow-50',
        'paid': 'border-blue-300 bg-blue-50',
        'delivered': 'border-green-300 bg-green-50',
        'received': 'border-purple-300 bg-purple-50'
    };
    return classes[status] || '';
}

function showSuccess(message) {
    successMessage.value = message;
    setTimeout(() => {
        successMessage.value = '';
    }, 5000);
}

// CSV Download function
function csvEscape(value) {
    if (value === null || value === undefined) return '';
    const str = String(value);
    // Escape double quotes by doubling them
    const escaped = str.replace(/"/g, '""');
    // Quote if contains comma, quote, or newline
    if (/[",\n]/.test(escaped)) {
        return `"${escaped}"`;
    }
    return escaped;
}

async function downloadCSV() {
    try {
        if (!auth.isAuthenticated) {
            alert('Authentication required');
            return;
        }

        loading.value = true;

        // Fetch all sales (no pagination)
        const params = {};
        if (statusFilter.value && statusFilter.value !== '') {
            params.status = statusFilter.value;
        }

        const response = await api.get(`/sales/data`, {
            params: { ...params, per_page: 1000000 } // large number to get all
        });

        let allSales = [];
        if (response.data.data) {
            allSales = response.data.data;
        } else if (Array.isArray(response.data)) {
            allSales = response.data;
        }

        if (!allSales || allSales.length === 0) {
            alert('No data available to download');
            loading.value = false;
            return;
        }

        // Define CSV headers
        const headers = [
            'Order ID',
            'Customer Name',
            'Email',
            'Phone',
            'Status',
            'Products',
            'Total Price (MAD)',
            'Date'
        ];

        // Convert data to CSV format
        const csvData = allSales.map(item => {
            // Format products list with '|' as separator
            let productsText = '';
            if (item.products && item.products.length > 0) {
                productsText = item.products.map(p => 
                    `${p.name || `Product ID: ${p.productId || p.product_id}`} (Qty: ${p.quantity} × ${formatPrice(p.price)} MAD)`
                ).join(' | ');
            } else {
                productsText = 'No products';
            }
            // Remove newlines and extra spaces
            productsText = productsText.replace(/\r?\n|\r/g, ' ').replace(/\s+/g, ' ').trim();

            return [
                `#${item.orderId || item.id}`,
                `${item.lastname || item.last_name || ''} ${item.firstname || item.first_name || ''}`.trim(),
                item.email || '',
                item.phone || '',
                formatStatus(item.status),
                productsText,
                formatPrice(item.totalPrice || item.total_price),
                formatDate(item.created_at || item.createdAt)
            ].map(csvEscape);
        });

        // Combine headers and data
        const csvContent = [headers.map(csvEscape), ...csvData]
            .map(row => row.join(';'))
            .join('\n');

        // Add UTF-8 BOM for Excel compatibility
        const BOM = '\uFEFF';
        const blob = new Blob([BOM + csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        
        if (link.download !== undefined) {
            const url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            
            // Generate filename with current date
            const now = new Date();
            const dateStr = now.toISOString().split('T')[0]; // YYYY-MM-DD format
            link.setAttribute('download', `sales_report_${dateStr}.csv`);
            
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            showSuccess('CSV file downloaded successfully!');
        } else {
            // Fallback for older browsers
            alert('CSV download is not supported in this browser');
        }
    } catch (error) {
        console.error('Error downloading CSV:', error);
        if (error.response?.status === 401) {
            alert('Session expired. Please log in again.');
            auth.clearAuth();
            window.location.href = '/login';
        } else {
            alert('Error downloading CSV file. Please try again.');
        }
    } finally {
        loading.value = false;
    }
}

// API functions
const sales = async () => {
    loading.value = true;
    error.value = null;
    try {
        if (!auth.isAuthenticated) {
            throw new Error('Authentication required');
        }

        // Build query parameters
        const params = {
            page: currentPage.value,
            per_page: itemsPerPage
        };

        // Add status filter if selected
        if (statusFilter.value && statusFilter.value !== '') {
            params.status = statusFilter.value;
        }

        const response = await api.get(`/sales/data`, {
            params: params
        });

        // Handle different response structures
        if (response.data.data) {
            sale.value = response.data.data;
            totalItems.value = response.data.total || response.data.data.length;
        } else if (Array.isArray(response.data)) {
            sale.value = response.data;
            totalItems.value = response.data.length;
        } else {
            sale.value = [];
            totalItems.value = 0;
        }


    } catch (err) {
        console.error('Error fetching sales:', err);
        console.error('Status:', err.response?.status);
        console.error('Response:', err.response?.data);
        if (err.response?.status === 401) {
            error.value = 'Session expired. Please log in again.';
            // Clear auth and redirect to login
            auth.clearAuth();
            window.location.href = '/login';
        } else if (err.response?.status === 403) {
            error.value = 'Access denied. You do not have permission to view sales data.';
        } else {
            error.value = err.response?.data?.message || err.message || 'Failed to load sales data';
        }
    } finally {
        loading.value = false;
    }
};

const updateSale = async (item) => {
    const orderId = item.orderId || item.id;
    updatingStatus.value = orderId;
    try {
        if (!auth.isAuthenticated) {
            throw new Error('Authentication required');
        }

        const response = await api.put(`/sales/update/${orderId}`, {
            status: item.status
        });

        showSuccess(`Order #${orderId} status updated to ${formatStatus(item.status)}`);
        // Refresh the current page data
        await sales();

    } catch (err) {
        console.error('Error updating sale:', err);
        console.error('Response:', err.response?.data);
        if (err.response?.status === 401) {
            error.value = 'Session expired. Please log in again.';
            // Clear auth and redirect to login
            auth.clearAuth();
            window.location.href = '/login';
        } else if (err.response?.status === 403) {
            error.value = 'Access denied. You do not have permission to update sales.';
        } else if (err.response?.status === 404) {
            error.value = 'Sale not found.';
        } else {
            error.value = err.response?.data?.message || 'Failed to update sale status';
        }
        // Revert the status change in UI
        await sales();
    } finally {
        updatingStatus.value = null;
    }
};

const fetchUserData = async () => {
    try {
        if (!auth.isAuthenticated) {
            console.warn('User not authenticated');
            return;
        }

        const response = await api.get(`/user/data`);

        user.value = response.data;

    } catch (err) {
        console.error(' Error fetching user data:', err);
        console.error(' Status:', err.response?.status);
        console.error(' Response:', err.response?.data);
        // Don't show error for user data fetch failure
        // as it's not critical for the sales list functionality
    }
};

const refreshData = async () => {
    await Promise.all([
        sales(),
        fetchUserData()
    ]);
};

const applyFilter = () => {
    currentPage.value = 1; // Reset to first page when filtering
    sales();
};

const clearFilter = () => {
    statusFilter.value = '';
    currentPage.value = 1;
    sales();
};

// Watchers
watch(currentPage, () => {
    sales();
});

watch(statusFilter, () => {
    applyFilter();
});

// Lifecycle
onMounted(async () => {
    // Ensure auth is checked before loading data
    if (!auth.authChecked) {
        await auth.fetchUser();
    }
    refreshData();
});
</script>
