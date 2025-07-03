<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <div class="flex h-screen overflow-hidden">
            <UserSideBar/>
            <!-- Main content -->
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <!-- Mobile menu button -->
                <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
                    <button type="button" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500">
                        <span class="sr-only">{{$t('open_sidebar') || 'Open sidebar'}}</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Top header -->
                <div class="flex-shrink-0 flex h-16 bg-white shadow">
                    <div class="flex-1 px-4 flex justify-between items-center">
                        <div class="flex-1 flex">
                            <h1 class="text-xl md:text-2xl font-semibold text-gray-900 self-center">{{$t('devis.title')}}</h1>
                        </div>
                        <!-- Refresh button -->
                        <button 
                            @click="fetchDevis"
                            :disabled="loading"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <svg :class="loading ? 'animate-spin' : ''" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            {{ loading ? $t('devis.refreshing') : $t('devis.refresh') }}
                        </button>
                    </div>
                </div>

                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-4 md:py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <!-- Loading State -->
                            <div v-if="loading" class="flex justify-center items-center py-12">
                                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-green-500"></div>
                                <span class="ml-3 text-gray-600">{{$t('devis.loading')}}</span>
                            </div>

                            <!-- Error State -->
                            <div v-else-if="error" class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">{{$t('devis.errors.unknown')}}</h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <p>{{ error }}</p>
                                        </div>
                                        <div class="mt-4">
                                            <button @click="fetchDevis" class="bg-red-100 px-3 py-2 rounded-md text-sm font-medium text-red-800 hover:bg-red-200">
                                                {{$t('devis.errors.retry')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Empty State -->
                            <div v-else-if="devis.length === 0" class="bg-white shadow rounded-lg">
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">{{$t('devis.empty.title')}}</h3>
                                    <p class="mt-1 text-sm text-gray-500">{{$t('devis.empty.description')}}</p>
                                    <div class="mt-6">
                                        <a href="/products" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                            {{$t('devis.empty.browse')}}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Devis List -->
                            <div v-else class="bg-white shadow rounded-lg overflow-hidden">
                                <div class="px-4 py-5 sm:px-6 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                                    <div>
                                        <h2 class="text-lg font-medium text-gray-900">{{$t('devis.list.header')}}</h2>
                                        <p class="mt-1 text-sm text-gray-500">{{$t('devis.list.count', { count: devis.length })}}</p>
                                    </div>
                                    <div class="mt-4 sm:mt-0">
                                        <span class="text-sm text-gray-500">
                                            {{$t('devis.list.total')}}: <span class="font-semibold text-gray-900">{{ formatPrice(calculateGrandTotal()) }} DH</span>
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Desktop Table -->
                                <div class="hidden md:block overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{$t('devis.list.id')}}
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{$t('devis.list.date')}}
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{$t('devis.list.product')}}
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{$t('devis.list.unitPrice')}}
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{$t('devis.list.quantity')}}
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{$t('devis.list.totalPrice')}}
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{$t('devis.list.status')}}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="devi in devis" :key="devi.id" class="hover:bg-gray-50 transition-colors duration-150">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    #{{ String(devi.id).padStart(4, '0') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ formatDate(devi.created_at) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">{{ devi.name || devi.product_name || $t('devis.list.product') }}</div>
                                                    <div v-if="devi.description" class="text-sm text-gray-500 truncate max-w-xs">{{ devi.description }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ formatPrice(devi.price || devi.unit_price || 0) }} DH
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ devi.quantity || devi.stock || 0 }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ formatPrice(calculateTotal(devi)) }} DH
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span :class="getStatusClass(devi.status)">
                                                        {{ formatStatus(devi.status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Mobile Card View -->
                                <div class="md:hidden">
                                    <div class="divide-y divide-gray-200">
                                        <div v-for="devi in devis" :key="devi.id" class="p-4 hover:bg-gray-50 transition-colors duration-150">
                                            <div class="flex justify-between items-start mb-2">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">#{{ String(devi.id).padStart(4, '0') }}</p>
                                                    <p class="text-xs text-gray-500">{{ formatDate(devi.created_at) }}</p>
                                                </div>
                                                <span :class="getStatusClass(devi.status)">
                                                    {{ formatStatus(devi.status) }}
                                                </span>
                                            </div>
                                            <div class="mb-3">
                                                <p class="text-sm font-medium text-gray-900">{{ devi.name || devi.product_name || $t('devis.list.product') }}</p>
                                                <p v-if="devi.description" class="text-xs text-gray-500 mt-1">{{ devi.description }}</p>
                                            </div>
                                            <div class="grid grid-cols-2 gap-4 text-sm">
                                                <div>
                                                    <p class="text-gray-500">{{$t('devis.list.unitPrice')}}</p>
                                                    <p class="font-medium">{{ formatPrice(devi.price || devi.unit_price || 0) }} DH</p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-500">{{$t('devis.list.quantity')}}</p>
                                                    <p class="font-medium">{{ devi.quantity || devi.stock || 0 }}</p>
                                                </div>
                                            </div>
                                            <div class="mt-3 pt-3 border-t border-gray-100">
                                                <div class="flex justify-between items-center">
                                                    <span class="text-sm text-gray-500">{{$t('devis.list.totalPrice')}}</span>
                                                    <span class="text-sm font-semibold text-gray-900">{{ formatPrice(calculateTotal(devi)) }} DH</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Summary Footer -->
                                <div class="bg-gray-50 px-4 py-4 sm:px-6">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-medium text-gray-900">{{$t('devis.list.total')}}</span>
                                        <span class="text-lg font-bold text-gray-900">{{ formatPrice(calculateGrandTotal()) }} DH</span>
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
import { onMounted, ref } from 'vue';
import axios from 'axios';
import UserSideBar from '../../components/UserSideBar.vue';
import { useI18n } from 'vue-i18n';

const devis = ref([]);
const loading = ref(true);
const error = ref('');

const API_BASE_URL = 'http://localhost:8000';

const { t } = useI18n();

const fetchDevis = async () => {
    loading.value = true;
    error.value = '';
    
    try {
        console.log('Fetching devis data...');
        
        const token = localStorage.getItem('token');
        if (!token) {
            throw new Error(t('devis.errors.expired'));
        }

        const response = await axios.get(`${API_BASE_URL}/api/devis`, {
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`
            }
        });

        console.log('API response:', response.data);

        // Handle different response structures
        let devisData;
        if (response.data.data) {
            devisData = response.data.data;
        } else if (Array.isArray(response.data)) {
            devisData = response.data;
        } else if (response.data.devis) {
            devisData = response.data.devis;
        } else {
            devisData = [];
        }

        devis.value = devisData;
        console.log('Devis loaded:', devis.value);

    } catch (err) {
        console.error('Error fetching devis:', err);
        
        if (err.response) {
            if (err.response.status === 401) {
                error.value = t('devis.errors.expired');
            } else if (err.response.status === 404) {
                error.value = t('devis.errors.notFound');
            } else if (err.response.status === 500) {
                error.value = t('devis.errors.server');
            } else {
                error.value = err.response.data?.message || t('devis.errors.unknown');
            }
        } else if (err.code === 'ERR_NETWORK') {
            error.value = t('devis.errors.network');
        } else if (err.message) {
            error.value = err.message;
        } else {
            error.value = t('checkout.toast_network_error');
        }
    } finally {
        loading.value = false;
    }
};

const formatDate = (dateString) => {
    if (!dateString) return 'Date inconnue';
    
    try {
        return new Date(dateString).toLocaleDateString('fr-FR', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    } catch (err) {
        return 'Date invalide';
    }
};

const formatPrice = (price) => {
    const numPrice = parseFloat(price) || 0;
    return new Intl.NumberFormat('fr-FR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(numPrice);
};

const calculateTotal = (devi) => {
    const price = parseFloat(devi.price || devi.unit_price || 0);
    const quantity = parseInt(devi.quantity || devi.stock || 0);
    return price * quantity;
};

const calculateGrandTotal = () => {
    return devis.value.reduce((total, devi) => total + calculateTotal(devi), 0);
};

const formatStatus = (status) => {
    const statusMap = {
        'active': t('devis.status.active'),
        'inactive': t('devis.status.inactive'),
    };
    return statusMap[status] || status || t('devis.status.unknown');
};

const getStatusClass = (status) => {
    const baseClasses = 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full';
    switch (status) {
        case 'active':
            return `${baseClasses} bg-green-100 text-green-800`;
        case 'inactive':
            return `${baseClasses} bg-red-100 text-red-800`;
        default:
            return `${baseClasses} bg-gray-100 text-gray-800`;
    }
};

onMounted(() => {
    fetchDevis();
});
</script>
