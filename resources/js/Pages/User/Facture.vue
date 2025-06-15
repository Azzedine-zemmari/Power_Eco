<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <div class="flex h-screen overflow-hidden">
            <UserSideBar/>
            <!-- Main content -->
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <!-- Top header -->
                <div class="flex-shrink-0 flex h-16 bg-white shadow">
                    <div class="flex-1 px-4 flex justify-between">
                        <div class="flex-1 flex">
                            <h1 class="text-xl md:text-2xl font-semibold text-gray-900 self-center">Factures</h1>
                        </div>
                    </div>
                </div>

                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-4 md:py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <!-- Factures List -->
                            <div class="bg-white shadow rounded-lg overflow-hidden">
                                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                                    <h2 class="text-lg font-medium text-gray-900">Liste des Factures</h2>
                                </div>
                                
                                <div class="overflow-x-auto">
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
                                            <tr v-for="order in orders" :key="order.orderId" class="hover:bg-gray-50">
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
                                                        <button @click="openModal(order)" class="text-green-600 hover:text-green-900">
                                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                        </button>
                                                        <button @click="downloadPDF(order)" class="text-blue-600 hover:text-blue-900">
                                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
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
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Client</h3>
                                <p class="text-gray-600">{{ selectedOrder?.firstname }} {{ selectedOrder?.lastname }}</p>
                                <p class="text-gray-600">{{ selectedOrder?.email }}</p>
                                <p class="text-gray-600">{{ selectedOrder?.phone }}</p>
                            </div>
                        </div>

                        <!-- Products Table -->
                        <div class="mt-6">
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
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" @click="downloadPDF(selectedOrder)" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Télécharger PDF
                        </button>
                        <button type="button" @click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
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

const data = async () => {
    try {
        const response = await axios.get('http://localhost:8000/api/factures', {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        orders.value = response.data.data || [];
        console.log('Orders data:', orders.value);
    } catch (error) {
        console.error('Error fetching orders:', error);
    }
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('fr-FR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
};

const formatPrice = (price) => {
    return new Intl.NumberFormat('fr-FR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(price);
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
    selectedOrder.value = order;
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    selectedOrder.value = null;
};

const downloadPDF = async (order) => {
    try {
        const doc = new jsPDF();
        
        // Add company logo or header
        doc.setFontSize(20);
        doc.text('Facture', 105, 20, { align: 'center' });
        
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
            product.quantity,
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
                fillColor: [41, 128, 185],
                textColor: 255,
                fontStyle: 'bold',
            },
            footStyles: {
                fillColor: [41, 128, 185],
                textColor: 255,
                fontStyle: 'bold',
            },
            alternateRowStyles: {
                fillColor: [245, 245, 245],
            },
        });
        
        // Save the PDF
        doc.save(`facture_${order.orderId}.pdf`);
    } catch (error) {
        console.error('Error generating PDF:', error);
    }
};

onMounted(data);
</script>   