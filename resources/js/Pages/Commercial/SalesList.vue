<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <div class="flex h-screen overflow-hidden">
            <CommercialSideBar />

            <!-- Main content -->
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <!-- Mobile menu button -->
                <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
                    <button type="button"
                        class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Top header -->
                <div class="flex-shrink-0 flex h-16 bg-white shadow">
                    <div class="flex-1 px-4 flex justify-between">
                        <div class="flex-1 flex">
                            <h1 class="text-2xl font-semibold text-gray-900 self-center">Dashboard</h1>
                        </div>
                        <div class="ml-4 flex items-center md:ml-6">
                            <!-- Notification dropdown -->
                            <div class="ml-3 relative">
                                <button
                                    class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <span class="sr-only">View notifications</span>
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Profile dropdown -->
                            <div class="ml-3 relative">
                                <div>
                                    <button type="button"
                                        class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full"
                                            src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt="">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main content area -->
                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <h1 class="text-2xl font-semibold text-gray-900">Welcome back, Michael</h1>
                        </div>
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <!-- Dashboard content -->
                            <div class="py-4">
                                <!-- Sales Table -->
                                <div class="mt-6">
                                    <h2 class="text-lg font-semibold mb-2">Sales Orders</h2>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full bg-white rounded shadow">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                        Order ID</th>
                                                    <th
                                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                        Status</th>
                                                    <th
                                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                        Product ID</th>
                                                    <th
                                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                        Quantity</th>
                                                    <th
                                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                        Price</th>
                                                    <th
                                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                        Total Price</th>
                                                    <th
                                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="item in sale" :key="item.orderId" class="border-t">
                                                    <td class="px-4 py-2">{{ item.orderId }}</td>
                                                    <td class="px-4 py-2">{{ item.status }}</td>
                                                    <td class="px-4 py-2">
                                                        <div v-for="p in item.products" :key="p.productId">
                                                            ID: {{ p.productId }}
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-2">
                                                        <div v-for="p in item.products" :key="p.productId">
                                                            {{ p.quantity }}
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-2">
                                                        <div v-for="p in item.products" :key="p.productId">
                                                            {{ p.price }}
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-2">{{ item.totalPrice }}</td>
                                                    <td class="flex justify-between items-center">
                                                        <select v-model="item.status" @change="updateSale(item)">
                                                            <option value="order">Order</option>
                                                            <option value="paid">Paid</option>
                                                            <option value="delivered">Delivered</option>
                                                            <option value="received">Received</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
import { onMounted, ref } from 'vue';
import axios from 'axios';

let sale = ref([]);

const sales = async () => {
    try {
        const response = await axios.get('http://localhost:8000/api/sales/data', {
            withCredentials: true,
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });

        sale.value = response.data;
        console.table(sale.value);
    } catch (error) {
        console.log('error', error);
    }
};

const updateSale = async (item) => {
  try {
    await axios.put(
      `http://localhost:8000/api/sales/update/${item.orderId}`,
      { status: item.status },
      {
        headers: {
          Accept: 'application/json',
          Authorization: `Bearer ${localStorage.getItem('token')}`
        }
      }
    );
    await sales();
  } catch (error) {
    alert('Failed to update order status');
  }
};

onMounted(sales);
</script>