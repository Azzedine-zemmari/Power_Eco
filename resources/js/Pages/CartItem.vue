<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <!-- Navigation -->
        <Navbar />
        <!-- Page Header -->
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">Your Cart</h1>
            </div>
        </div>

        <!-- Cart Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start xl:gap-x-16">
                <!-- Cart Items -->
                <section aria-labelledby="cart-heading" class="lg:col-span-7">
                    <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>

                    <ul role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200">
                        <!-- Cart Item -->
                        <li v-for="item in items" :key="item.product_id" class="py-6 flex">
                            <div class="flex-shrink-0">
                                <img :src="`storage/${item.product_image}`" :alt="item.product_name"
                                    class="w-24 h-24 rounded-md object-center object-cover sm:w-32 sm:h-32">
                            </div>

                            <div class="ml-4 flex-1 flex flex-col sm:ml-6">
                                <div>
                                    <div class="flex justify-between">
                                        <h4 class="text-sm">
                                            <a :href="`/product/${item.product_id}`"
                                                class="font-medium text-gray-700 hover:text-gray-800">{{
                                                item.product_name }}</a>
                                        </h4>
                                        <p class="ml-4 text-sm font-medium text-gray-900">MAD {{ item.product_price }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 flex-1 flex items-end justify-between">
                                    <div class="flex items-center space-x-2">
                                        <label :for="`quantity-${item.product_id}`" class="text-sm font-medium text-gray-700">
                                            Quantity:
                                        </label>
                                        <select 
                                            :id="`quantity-${item.product_id}`"
                                            :name="`quantity-${item.product_id}`"
                                            :value="item.quantity"
                                            @change="updateQuantity(item, $event.target.value)"
                                            class="rounded-md border border-gray-300 text-base font-medium text-gray-700 text-left shadow-sm focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            <option v-for="q in 10" :key="q" :value="q">{{ q }}</option>
                                        </select>
                                    </div>

                                    <button @click="removeItem(item)" type="button"
                                        class="ml-4 text-sm font-medium text-red-600 hover:text-red-500">
                                        <span>Remove</span>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <!-- Empty Cart State -->
                    <div v-if="items.length === 0" class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Your cart is empty</h3>
                        <p class="mt-1 text-sm text-gray-500">Start adding some eco-friendly products!</p>
                        <div class="mt-6">
                            <a href="/products" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </section>

                <!-- Order Summary -->
                <section v-if="items.length > 0" aria-labelledby="summary-heading"
                    class="mt-16 bg-white rounded-lg px-4 py-6 sm:p-6 lg:p-8 lg:mt-0 lg:col-span-5">
                    <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order summary</h2>

                    <dl class="mt-6 space-y-4">
                        <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                            <dt class="text-base font-medium text-gray-900">Order total</dt>
                            <dd class="text-base font-medium text-gray-900">MAD {{ total.toFixed(2) }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6">
                        <a href="/checkout"
                            class="w-full bg-green-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 flex items-center justify-center">
                            Proceed to Checkout
                        </a>
                    </div>

                    <div class="mt-6 text-sm text-center text-gray-500">
                        <p>
                            or <a href="/products" class="text-green-600 font-medium hover:text-green-500">Continue
                                Shopping<span aria-hidden="true"> &rarr;</span></a>
                        </p>
                    </div>

                    <!-- Eco-friendly message -->
                    <div class="mt-8 border-t border-gray-200 pt-6">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="ml-2 text-sm text-gray-500">
                                Your purchase helps reduce carbon emissions and supports sustainable living.
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<script setup>
import Navbar from '../components/Navbar.vue';
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

const items = ref([])

// Computed properties for order summary
const total = computed(() => {
    return items.value.reduce((sum, item) => {
        return sum + (parseFloat(item.product_price) * parseInt(item.quantity));
    }, 0);
});


const cartItems = async () => {
    try {
        const response = await axios.get('/api/cart', {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        
        items.value = response.data.cart_items;
        console.log(items.value);
    } catch (error) {
        console.error(error);
        alert('Failed to load cart');
    }
}

const updateQuantity = async (item, newQuantity) => {
    const oldQuantity = item.quantity; // Store old quantity for rollback
    
    try {
        item.quantity = parseInt(newQuantity);
        
        await axios.put(`/api/cart/${item.product_id}`, {
            quantity: parseInt(newQuantity)
        }, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        
        console.log('Quantity updated successfully');
    } catch (error) {
        console.error(error);
        alert('Failed to update quantity');
        // Rollback the quantity on error
        item.quantity = oldQuantity;
    }
};

const removeItem = async (item) => {
    try {
        console.log(item)
        await axios.delete(`/api/cart/${item.id}/drop`, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        
        // Remove item from local state
        items.value = items.value.filter(cartItem => cartItem.product_id !== item.product_id);
        
        console.log('Item removed successfully');
    } catch (error) {
        console.error(error);
        alert('Failed to remove item');
    }
};

onMounted(cartItems);
</script>