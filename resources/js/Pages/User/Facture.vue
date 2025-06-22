<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <div class="flex h-screen overflow-hidden">
            <UserSideBar/>
            <!-- Main content -->
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <!-- Top header -->
                <div class="flex-shrink-0 flex h-16 bg-white shadow">
                    <div class="flex-1 px-4 flex justify-between items-center">
                        <div class="flex-1 flex">
                            <h1 class="text-xl md:text-2xl font-semibold text-gray-900 self-center">Factures</h1>
                        </div>
                        <!-- Refresh button -->
                        <button 
                            @click="data"
                            :disabled="loading"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <svg :class="loading ? 'animate-spin' : ''" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            {{ loading ? 'Actualisation...' : 'Actualiser' }}
                        </button>
                    </div>
                </div>

                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-4 md:py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <!-- Loading State -->
                            <div v-if="loading" class="flex justify-center items-center py-12">
                                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-green-500"></div>
                                <span class="ml-3 text-gray-600">Chargement des factures...</span>
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
                                        <h3 class="text-sm font-medium text-red-800">Erreur de chargement</h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <p>{{ error }}</p>
                                        </div>
                                        <div class="mt-4">
                                            <button @click="data" class="bg-red-100 px-3 py-2 rounded-md text-sm font-medium text-red-800 hover:bg-red-200">
                                                Réessayer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Empty State -->
                            <div v-else-if="!loading && orders.length === 0" class="bg-white shadow rounded-lg">
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune facture</h3>
                                    <p class="mt-1 text-sm text-gray-500">Vous n'avez pas encore de factures.</p>
                                </div>
                            </div>

                            <!-- Factures List -->
                            <div v-else class="bg-white shadow rounded-lg overflow-hidden">
                                <div class="px-4 py-5 sm:px-6 border-b border-gray-200 flex justify-between items-center">
                                    <div>
                                        <h2 class="text-lg font-medium text-gray-900">Liste des Factures</h2>
                                        <p class="mt-1 text-sm text-gray-500">{{ orders.length }} facture(s) au total</p>
                                    </div>
                                </div>
                                
                                <!-- Desktop Table -->
                                <div class="hidden md:block overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    ID Commande
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Date
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Montant Total
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Statut
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="order in orders" :key="order.orderId" class="hover:bg-gray-50 transition-colors duration-150">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    #ORD_{{ order.orderId }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ formatDate(order.created_at) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ formatPrice(order.totalPrice) }} DH
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span :class="[
                                                        'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                                        order.status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                                        order.status === 'completed' ? 'bg-green-100 text-green-800' :
                                                        'bg-red-100 text-red-800'
                                                    ]">
                                                        {{ formatStatus(order.status) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <div class="flex space-x-3">
                                                        <button 
                                                            @click="openModal(order)" 
                                                            :disabled="modalLoading"
                                                            class="text-green-600 hover:text-green-900 disabled:opacity-50 disabled:cursor-not-allowed"
                                                            title="Voir les détails"
                                                        >
                                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                        </button>
                                                        <button 
                                                            @click="downloadPDF(order)" 
                                                            :disabled="downloadingIds.includes(order.orderId)"
                                                            class="text-blue-600 hover:text-blue-900 disabled:opacity-50 disabled:cursor-not-allowed"
                                                            title="Télécharger PDF"
                                                        >
                                                            <svg v-if="downloadingIds.includes(order.orderId)" class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                            </svg>
                                                            <svg v-else class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Mobile Card View -->
                                <div class="md:hidden">
                                    <div class="divide-y divide-gray-200">
                                        <div v-for="order in orders" :key="order.orderId" class="p-4 hover:bg-gray-50 transition-colors duration-150">
                                            <div class="flex justify-between items-start mb-2">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">#ORD_{{ order.orderId }}</p>
                                                    <p class="text-xs text-gray-500">{{ formatDate(order.created_at) }}</p>
                                                </div>
                                                <span :class="[
                                                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                                    order.status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                                    order.status === 'completed' ? 'bg-green-100 text-green-800' :
                                                    'bg-red-100 text-red-800'
                                                ]">
                                                    {{ formatStatus(order.status) }}
                                                </span>
                                            </div>
                                            <div class="mb-3">
                                                <p class="text-sm font-semibold text-gray-900">{{ formatPrice(order.totalPrice) }} DH</p>
                                            </div>
                                            <div class="flex space-x-3">
                                                <button 
                                                    @click="openModal(order)" 
                                                    :disabled="modalLoading"
                                                    class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed"
                                                >
                                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Voir détails
                                                </button>
                                                <button 
                                                    @click="downloadPDF(order)" 
                                                    :disabled="downloadingIds.includes(order.orderId)"
                                                    class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
                                                >
                                                    <svg v-if="downloadingIds.includes(order.orderId)" class="animate-spin h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                    <svg v-else class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                    {{ downloadingIds.includes(order.orderId) ? 'Téléchargement...' : 'PDF' }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Success Message -->
                            <div v-if="successMessage" class="mt-6 bg-green-50 border border-green-200 rounded-md p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-green-800">{{ successMessage }}</p>
                                    </div>
                                    <div class="ml-auto pl-3">
                                        <button @click="successMessage = ''" class="inline-flex text-green-400 hover:text-green-500">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!-- Invoice Modal -->
        <div v-if="showModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="closeModal"></div>

                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                    <!-- Modal Loading State -->
                    <div v-if="modalLoading" class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex justify-center items-center py-12">
                            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-green-500"></div>
                            <span class="ml-3 text-gray-600">Chargement des détails...</span>
                        </div>
                    </div>

                    <!-- Modal Content -->
                    <div v-else class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <!-- Invoice Header -->
                        <div class="border-b border-gray-200 pb-4 mb-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900">Facture</h2>
                                    <p class="text-gray-600">#ORD_{{ selectedOrder?.orderId }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-gray-600">Date: {{ formatDate(selectedOrder?.created_at) }}</p>
                                    <p class="text-gray-600">Statut: {{ formatStatus(selectedOrder?.status) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Client</h3>
                                <p class="text-gray-600">{{ selectedOrder?.firstname }} {{ selectedOrder?.lastname }}</p>
                                <p class="text-gray-600">{{ selectedOrder?.email }}</p>
                                <p class="text-gray-600">{{ selectedOrder?.phone }}</p>
                            </div>
                        </div>

                        <!-- Products Table -->
                        <div class="mt-6 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Produit
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Quantité
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Prix Unitaire
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="product in selectedOrder?.products" :key="product.productId">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Produit #{{ product.productId }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ product.quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ formatPrice(product.price) }} DH
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ formatPrice(product.price * product.quantity) }} DH
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot class="bg-gray-50">
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-right text-sm font-medium text-gray-900">
                                            Total
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                            {{ formatPrice(selectedOrder?.totalPrice) }} DH
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button 
                            type="button" 
                            @click="downloadPDF(selectedOrder)" 
                            :disabled="downloadingIds.includes(selectedOrder?.orderId)"
                            class="w-full inline-flex justify-center items-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <svg v-if="downloadingIds.includes(selectedOrder?.orderId)" class="animate-spin h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <svg v-else class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            {{ downloadingIds.includes(selectedOrder?.orderId) ? 'Téléchargement...' : 'Télécharger PDF' }}
                        </button>
                        <button 
                            type="button" 
                            @click="closeModal" 
                            :disabled="modalLoading"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';
import UserSideBar from '../../components/UserSideBar.vue';
import { jsPDF } from 'jspdf';
import autoTable from 'jspdf-autotable';

const orders = ref([]);
const showModal = ref(false);
const selectedOrder = ref(null);
const loading = ref(true);
const modalLoading = ref(false);
const downloadingIds = ref([]);
const error = ref('');
const successMessage = ref('');

const data = async () => {
    loading.value = true;
    error.value = '';
    
    try {
        const response = await axios.get('http://localhost:8000/api/factures', {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        orders.value = response.data.data || [];
        console.log('Orders data:', orders.value);
    } catch (err) {
        console.error('Error fetching orders:', err);
        
        if (err.response) {
            if (err.response.status === 401) {
                error.value = 'Session expirée. Veuillez vous reconnecter.';
            } else if (err.response.status === 404) {
                error.value = 'Service non trouvé.';
            } else {
                error.value = err.response.data?.message || 'Erreur lors du chargement des factures.';
            }
        } else if (err.code === 'ERR_NETWORK') {
            error.value = 'Impossible de se connecter au serveur.';
        } else {
            error.value = 'Erreur réseau. Vérifiez votre connexion.';
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

const formatStatus = (status) => {
    const statusMap = {
        'pending': 'En attente',
        'completed': 'Complété',
        'cancelled': 'Annulé'
    };
    return statusMap[status] || status;
};

const openModal = (order) => {
    modalLoading.value = true;
    selectedOrder.value = order;
    showModal.value = true;
    
    // Simulate loading time for modal content
    setTimeout(() => {
        modalLoading.value = false;
    }, 500);
};

const closeModal = () => {
    showModal.value = false;
    selectedOrder.value = null;
    modalLoading.value = false;
};

const downloadPDF = async (order) => {
    // Add order ID to downloading list
    downloadingIds.value.push(order.orderId);
    
    try {
        const doc = new jsPDF();
        
        // Add company logo or header
        doc.setFontSize(20);
        doc.text('EcoMove - Facture', 105, 20, { align: 'center' });
        
        // Add order information
        doc.setFontSize(12);
        doc.text(`Commande #ORD_${order.orderId}`, 20, 40);
        doc.text(`Date: ${formatDate(order.created_at)}`, 20, 50);
        doc.text(`Statut: ${formatStatus(order.status)}`, 20, 60);
        
        // Add customer information
        doc.text('Informations Client:', 20, 80);
        doc.text(`${order.firstname} ${order.lastname}`, 20, 90);
        doc.text(`Email: ${order.email}`, 20, 100);
        doc.text(`Téléphone: ${order.phone}`, 20, 110);
        
        // Add products table
        const tableColumn = ['Produit', 'Quantité', 'Prix Unitaire', 'Total'];
        const tableRows = order.products.map(product => [
            `Produit #${product.productId}`,
            product.quantity.toString(),
            `${formatPrice(product.price)} DH`,
            `${formatPrice(product.price * product.quantity)} DH`
        ]);
        
        // Add total row
        tableRows.push(['', '', 'Total', `${formatPrice(order.totalPrice)} DH`]);
        
        autoTable(doc, {
            startY: 130,
            head: [tableColumn],
            body: tableRows,
            theme: 'grid',
            styles: {
                fontSize: 10,
                cellPadding: 5,
            },
            headStyles: {
                fillColor: [22, 163, 74], // Green color
                textColor: 255,
                fontStyle: 'bold',
            },
            footStyles: {
                fillColor: [22, 163, 74],
                textColor: 255,
                fontStyle: 'bold',
            },
            alternateRowStyles: {
                fillColor: [245, 245, 245],
            },
        });
        
        // Add footer
        const pageHeight = doc.internal.pageSize.height;
        doc.setFontSize(8);
        doc.text('EcoMove - Solutions écologiques pour un avenir durable', 105, pageHeight - 20, { align: 'center' });
        doc.text(`Généré le ${new Date().toLocaleDateString('fr-FR')}`, 105, pageHeight - 10, { align: 'center' });
        
        // Save the PDF
        doc.save(`facture_ORD_${order.orderId}.pdf`);
        
        // Show success message
        successMessage.value = `Facture #ORD_${order.orderId} téléchargée avec succès!`;
        setTimeout(() => {
            successMessage.value = '';
        }, 3000);
        
    } catch (err) {
        console.error('Error generating PDF:', err);
        error.value = 'Erreur lors de la génération du PDF.';
        setTimeout(() => {
            error.value = '';
        }, 5000);
    } finally {
        // Remove order ID from downloading list
        downloadingIds.value = downloadingIds.value.filter(id => id !== order.orderId);
    }
};

onMounted(data);
</script>
